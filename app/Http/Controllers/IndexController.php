<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trainings;
use App\Models\Lektors;
use App\Models\Discounts;
use App\Models\Lessons;
use App\Models\Requests;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use View;
use Jenssegers\Date\Date;

class IndexController extends Controller
{
  //put your code here
    
    
    
    
  
  public function index()
  {
       $trainings = Trainings::select(['id','name','begin_date','end_date','url','type','lektor_id','is_static'])->where(['status'=>1])->orderBy('is_static','asc')->get();
       $lektors = Lektors::select()->get(['id','name_surname','description','image']);
     //  dump($trainings); 
       

//       , 'end_date'=> $end_date
       
       for ($i = 0; $i<count($trainings); $i++)
       {
  $trainings[$i]->end_date = strtotime($trainings[$i]->end_date);
  $trainings[$i]->end_date = new Date($trainings[$i]->end_date);  
  $trainings[$i]->end_date = $trainings[$i]->end_date->format('j F');
       }
    return view('index')->with(['trainings' =>$trainings, 'lektors' => $lektors]);
  }
  
  
   public function viewDetails($url) {

     $training = Trainings::where('url',$url)->first();
     if ($training == null) {
      return view('errors.404', ['message' => 'Training not found']);
    }
  $lessons = DB::table('lessons')->where('training_id' ,$training->id)->where('status', 1)->get();
 
  $lektors = DB::table('lektors')->where('id' ,$training->lektor_id)->get();
  $all_lektors = DB::table('lektors')->get();
 // $lektor = $lektors[0];  //->name_surname
 // dump($lessons);
  
//    View::composer('layouts.training', function($view)
//{
//    $view->with('training', $training);
//});
  $timestamp = strtotime($training->end_date);
  $end_date = new Date($timestamp);
  $end_date = $end_date->format('j F');
 // $end_date = strtotime($end_date);
  //$teststr =  strstr($end_date, ' ', true);
  //$teststr[0] =  strtoupper($teststr[0]);
  return view('training',['training'=>$training, 'lektor'=>$lektors, 'lessons'=>$lessons, 'end_date'=> $end_date, 'all_lektors'=>$all_lektors]);
  }
  
  public function update(Request $request) {
   
    $id = $request->input('id', '');
//dump($request);
    $res = [];
    $a=0;
    $disc = '';
    $validator = Validator::make($request->all(), [
        'PIB' => 'required|string|max:1024',
        'company_name' =>'string|max:1024',
        'sphere' =>'string|max:2048',
        'E_mail' => 'required|email|max:1024',
        'phone_number' => 'required|string|max:1024',
        'lessons_to_visit' => 'string|max:2048',
        'promo' => 'string|max:2048',
        //'wishes' => 'required|string|max:2048',
    ]);

    if ($validator->fails()) {
      if ($id)
      {
        return redirect('admin/requests/edit/' . $id)
            ->withErrors($validator)
            ->withInput();
      }
      else
      {
        //$res = ['res' => 'error', 'message' => 'Ви ввели некоректні дані!'];
        return response()->json(array('error' => 'yes', 'message' => 'Ви ввели некоректні дані!'), 200);
      }
      
    }
    
    else 
        if( $request->input('promo') != '' )
    {
        $discounts = Discounts::select(['id','training_id','code','value','status'])->where('code', $request->input('promo'))->where('status', 1)->first();
       
                    if ($discounts!=null)
                    {                
                    $a=1;
                    $disc = $discounts->value;
                    $discountWhere = Discounts::find($discounts->id);
                    $discountWhere->count--;
                    $discountWhere->save();
                    if ($discountWhere->count == 0)
                    {
                      $discountWhere->status = 2;
                    }
                    
                    $discountWhere->save();
                    
                    
                    }

        if($a!=1)
        {
             return response()->json(array('error' => 'yes', 'message' => 'Промо-код не дійсний, можливо ви зробили помилку' ), 200);
        }    
    }
    else { $res = ['res' => 'ok', 'message' => 'Все добре!'];    }

    
    if ($id)
    {
      $Requests = Requests::find($id);
      $Requests->update($request->except('_token'));
       return redirect('/admin/requests');
    }
    else
    {
    
      $r = $request->except('_token');
      
      $Requests = Requests::create($r);
      
      if($disc!='')
      {
    $idd =  DB::table('requests')->max('id');
    $rr = Requests::find($idd);
    $rr->discount_value = $disc;
    $rr->save();
      }
    
      //return json_encode($res);
      return response()->json(array('error' => 'no', 'message' => 'Все добре!', 'discount' => $disc), 200);
    }
    
    //ppr($r);
    //ppre($brand);
    
    return back();
  }
  
  
  public function checkCode(Request $request) {
     
       $id = $request->input('id', '');
       $promo = $request->input('promo_code', '');
      
$discounts = Discounts::select(['id','training_id','code','value','status'])->where('training_id', $id)->where('code', $promo)->where('status', 1)->first();
       
 if ($discounts!=null)
 {
    return response()->json(array('error' => 'no', 'message' => 'Промо-код дійсний', 'discount' => $discounts->value ), 200);
 }
 else 
 {
    return response()->json(array('error' => 'yes', 'message' => 'Промо-код не дійсний', 'discount' => 0), 200);
 }
//       for ($i = 0; $i<count($discounts); $i++)
//       {
//           if($id == $discounts[$i]->training_id)
//           {
//               if($promo == $discounts[$i]->code)
//               {
//                   if($discounts[$i]->status == 1)
//                   {
//                    return response()->json(array('error' => 'no', 'message' => 'Промо-код дійсний', 'discount' => $discounts[$i]->value ), 200);
//                   }
//               }
//           }
//       }
       
       
      
  }
  
}