<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trainings;
use App\Models\Lektors;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;
use Validator;
use DB;

class TrainingsController extends Controller
{
     public function __construct() {
    $this->middleware('auth');
  }
  
  public function index() {
    return view('admin.trainings.index');
  }
  
  public function create()
  {
      $training = new Trainings;
      $lektors = DB::table('lektors')->select('name_surname', 'id')->get();
   
     return view('admin.trainings.edit',['trainings'=>$training, 'lektors'=>$lektors]);
  }

  
  // обработка запроса на ajax с index.blade.php
  public function anyData() {
    return Datatables::of(Trainings::query())->addColumn('action', function ($training) {

        $edit = '<a href="/admin/trainings/edit/' . $training->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
        if ($training->status == 1) {
          $block = '<span id="b' . $training->id . '" data-id="' . $training->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        } else {
          $block = '<span id="b' . $training->id . '" data-id="' . $training->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        }
        $delete = '<span id="d' . $training->id . '" data-id="' . $training->id . '"  class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-trash"></i>Удалить</span>';
       
        return $edit . ' ' . $block . ' ' . $delete;
      })->addColumn('status', function($training) {
        $status = ($training->status == 1) ? "<span id='s" . $training->id . "'>Активный</span>" : "<span id='s" . $training->id . "' >Заблокирован</span>";
        return $status;
      })
              ->addColumn('lektor_id', function($training) {
        $lektors = DB::table('lektors')->select('name_surname', 'id')->get();
        for ($i=0; $i<count($lektors); $i++)
        {
            if($training->lektor_id == $lektors[$i]->id)
            {
        $lektor_name = "<span>{$lektors[$i]->name_surname}</span>" ;
            }
        }    
        return $lektor_name;
      })
              ->addColumn('image',function($training)
        {
           $image = ($training->image)&&(File::exists(public_path($training->image)))? "<img src='$training->image' alt='image' width='150px' >":"";
           return $image;
        })->make(true);
  }

  public function edit($id) {

    $training = Trainings::find($id);
    $lektors = DB::table('lektors')->select('name_surname', 'id')->get();
    if ($training == null) {
      return view('errors.404', ['message' => 'Training not found']);
    }
 return view('admin.trainings.edit',['trainings'=>$training, 'lektors'=>$lektors]);
   // return view('admin.trainings.edit', ['trainings' => $trainings]);
  }

  public function update(Request $request) {
   //dump($request);
    $id = $request->input('id', '');
//dump($request);
    
   // if($request->input('is_static')==1)
  //  {
//         $validator = Validator::make($request->all(), [
//        'description' => 'required|max:2000',
//        'name' => 'required|string|max:1024',
//        'internal_title' => 'required|string|max:2000',
//        
//    ]);
        
  //  }
  //   else {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:2000',
        'begin_date' =>'required|date',
        'end_date' =>'required|date|after:begin_date',
        'name' => 'required|string|max:1024',
        'description' => 'required|max:2000',
        'url' => 'required',
        'type' =>'required',
        'internal_title' => 'required|string|max:2000',
        'full_price' => 'required',
        'adress_where' => 'required',
         'adress' => 'required',
        'image'=>'required',
        'lektor_id' => 'required',
        'status' => 'required',
        'is_static' => 'required',
        'time_from' => 'required',
         'time_to' => 'required',
  ]); 
    
    // }

    if ($validator->fails()) {
        
         return response()->json(array('res' => 'no', 'message' => 'Ви ввели некоректні дані!'), 200);
//      if ($id)
//      {
//        return redirect('admin/trainings/edit/' . $id)
//            ->withErrors($validator)
//            ->withInput();
//      }
//      else
//      {
//        return redirect('admin/trainings/create/')
//            ->withErrors($validator)
//            ->withInput();
//      }
      
    }
    else
    {

    if ($id)  
    {
      $trainings = Trainings::find($id);
      $trainings->update($request->except('_token'));
    }
    else
    {
        
        
        
      $r = $request->except('_token');
     
       if($request->input('is_static')==1)
    {
           $r["begin_date"] = date("Y-m-d");
           $r["end_date"]  = date("Y-m-d");
           $r["full_price"]  = 0;
    }
      
      
     // dump($r);
      $trainings = Trainings::create($r);
    }
    
    //ppr($r);
    //ppre($brand);
    
 //  return redirect('/admin/trainings');
     return response()->json(array('res' => 'ok', 'message' => 'all right!'), 200);
    }
  }

  public function change_status(Request $request) {
    $res = [];
    $id = $request->input('trainings_id');
    $trainings = Trainings::find($id);

    if (!($trainings == null)) {
      if ($trainings->status == 1) {
        $block_button = '<span id="b' . $trainings->id . '" data-id="' . $trainings->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        $status = "<span id='s" . $trainings->id . "' >Заблокирован</span>";
        $trainings->status = 2;
      } else {
        $block_button = '<span id="b' . $trainings->id . '" data-id="' . $trainings->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        $status = "<span id='s" . $trainings->id . "'>Активный</span>";
        $trainings->status = 1;
      }
      $trainings->save();
      $res = ['res' => 'ok', 'block_button' => $block_button, 'status' => $status];
    } else {
      $res = ['res' => 'error', 'message' => 'Error : User not found'];
    }

    return json_encode($res);
  }
  
   public function delete(Request $request) {
    $res = [];
    $id = $request->input('trainings_id');
    $trainings = Trainings::find($id);

    if (!($trainings == null)) {
     
      $trainings->delete();
      $res = ['res' => 'ok'];
    } else {
      $res = ['res' => 'error', 'message' => 'Error : User not found'];
    }

    return json_encode($res);
  }
  
  
  
}
