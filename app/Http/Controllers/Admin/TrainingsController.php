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

        $delete = ''; //'<a href="#edit-' . $user->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
   
    $id = $request->input('id', '');
//dump($request);
    $validator = Validator::make($request->all(), [
        'description' => 'required|max:2000',
        'begin_date' =>'required|date',
        'end_date' =>'required|date|after:begin_date',
        'name' => 'required|string|max:1024',
    ]);

    if ($validator->fails()) {
      if ($id)
      {
        return redirect('admin/trainings/edit/' . $id)
            ->withErrors($validator)
            ->withInput();
      }
      else
      {
        return redirect('admin/trainings/create/')
            ->withErrors($validator)
            ->withInput();
      }
      
    }

    if ($id)
    {
      $trainings = Trainings::find($id);
      $trainings->update($request->except('_token'));
    }
    else
    {
      $r = $request->except('_token');
      
      $trainings = Trainings::create($r);
    }
    
    //ppr($r);
    //ppre($brand);
    
    return redirect('/admin/trainings');
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
}
