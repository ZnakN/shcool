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
use App\Models\Lessons;
use App\Models\Requests;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use View;

class IndexController extends Controller
{
  //put your code here
    
    
    
    
  
  public function index()
  {
       $trainings = Trainings::select(['id','name','begin_date','end_date','url','type'])->get();
       $lektors = Lektors::select(['id','name_surname'])->get();
     //  dump($trainings);
    return view('index')->with(['trainings' =>$trainings, 'lektors' => $lektors]);
  }
  
  
   public function viewDetails($url) {

     $training = Trainings::where('url',$url)->first();
     if ($training == null) {
      return view('errors.404', ['message' => 'Training not found']);
    }
  $lessons = DB::table('Lessons')->where('training_id' ,$training->id)->where('status', 1)->get();
 
  $lektors = DB::table('Lektors')->where('id' ,$training->lektor_id)->get();
 // $lektor = $lektors[0];  //->name_surname
 // dump($lessons);
  
//    View::composer('layouts.training', function($view)
//{
//    $view->with('training', $training);
//});
  
  return view('training',['training'=>$training, 'lektor'=>$lektors, 'lessons'=>$lessons]);
  }
  
  public function update(Request $request) {
   
    $id = $request->input('id', '');
//dump($request);
    $res = [];
    
    $validator = Validator::make($request->all(), [
        'PIB' => 'required|string|max:1024',
        'company_name' =>'required|string|max:1024',
        'sphere' =>'required|string|max:2048',
        'E_mail' => 'required|email|max:1024',
        'phone_number' => 'required|string|max:1024',
        'lessons_to_visit' => 'string|max:2048',
        'promo' => 'string|max:2048',
        'wishes' => 'required|string|max:2048',
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
      //return json_encode($res);
      return response()->json(array('error' => 'no', 'message' => 'Все добре!'), 200);
    }
    
    //ppr($r);
    //ppre($brand);
    
    return back();
  }
  
  
}