<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trainings;
use App\Models\Lektors;
use App\Models\Lessons;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;
use Validator;
use DB;

class LessonsController extends Controller
{
     public function __construct() {
    $this->middleware('auth');
  }
  
  public function index() {
    return view('admin.lessons.index');
  }
  
  public function create()
  {
      $lesson = new Lessons;
      $tranings = Trainings::all();
    
      return view('admin.lessons.edit',['lesson'=>$lesson, 'trainings'=>$tranings]);
  }

  
  // обработка запроса на ajax с index.blade.php
  public function anyData() {
    return Datatables::of(Lessons::query())->addColumn('action', function ($lesson) {

        $edit = '<a href="/admin/lessons/edit/' . $lesson->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
        if ($lesson->status == 1) {
          $block = '<span id="b' . $lesson->id . '" data-id="' . $lesson->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        } else {
          $block = '<span id="b' . $lesson->id . '" data-id="' . $lesson->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        }
 $delete = '<span id="d' . $lesson->id . '" data-id="' . $lesson->id . '"  class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-trash"></i>Удалить</span>';
      //  $delete = ''; //'<a href="#edit-' . $user->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        return $edit . ' ' . $block . ' ' . $delete;
      })->addColumn('status', function($lesson) {
        $status = ($lesson->status == 1) ? "<span id='s" . $lesson->id . "'>Активный</span>" : "<span id='s" . $lesson->id . "' >Заблокирован</span>";
        return $status;
      })
              ->addColumn('training_id', function($lesson) {
            
        return $lesson->training->name;
      })->make(true);
  }

  public function edit($id) {

    $lesson = Lessons::find($id);
    $tranings = Trainings::all();
    if ($lesson == null) {
      return view('errors.404', ['message' => 'Урок не найден']);
    }
 return view('admin.lessons.edit',['lesson'=>$lesson, 'trainings'=> $tranings]);
   // return view('admin.trainings.edit', ['trainings' => $trainings]);
  }

  public function update(Request $request) {
   
    $id = $request->input('id', '');
//dump($request);
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:1024',
        'description' => 'required|max:2000',
        'price' => 'required',
        'training_id' => 'required',
        'status' => 'required'
    ]);

    if ($validator->fails()) {
//      if ($id)
//      {
//        return redirect('admin/lessons/edit/' . $id)
//            ->withErrors($validator)
//            ->withInput();
//      }
//      else
//      {
//        return redirect('admin/lessons/create/')
//            ->withErrors($validator)
//            ->withInput();
//      }
        return response()->json(array('res' => 'no', 'message' => 'Ви ввели некоректні дані!'), 200);
    }

    if ($id)
    {
      $lesson = Lessons::find($id);
      $lesson->update($request->except('_token'));
    }
    else
    {
      $r = $request->except('_token');
      
      $lesson = Lessons::create($r);
    }
    
    //ppr($r);
    //ppre($brand);
    
    return response()->json(array('res' => 'ok', 'message' => 'all right!'), 200);
  }

  public function change_status(Request $request) {
    $res = [];
    $id = $request->input('lesson_id');
    $lesson = Lessons::find($id);

    if (!($lesson == null)) {
      if ($lesson->status == 1) {
        $block_button = '<span id="b' . $lesson->id . '" data-id="' . $lesson->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        $status = "<span id='s" . $lesson->id . "' >Заблокирован</span>";
        $lesson->status = 2;
      } else {
        $block_button = '<span id="b' . $lesson->id . '" data-id="' . $lesson->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        $status = "<span id='s" . $lesson->id . "'>Активный</span>";
        $lesson->status = 1;
      }
      $lesson->save();
      $res = ['res' => 'ok', 'block_button' => $block_button, 'status' => $status];
    } else {
      $res = ['res' => 'error', 'message' => 'Error : Урок не найден'];
    }

    return json_encode($res);
  }
  
    public function delete(Request $request) {
    $res = [];
    $id = $request->input('lesson_id');
    $trainings = Lessons::find($id);

    if (!($trainings == null)) {
     
      $trainings->delete();
      $res = ['res' => 'ok'];
    } else {
      $res = ['res' => 'error', 'message' => 'Error : User not found'];
    }

    return json_encode($res);
  }
  
}
