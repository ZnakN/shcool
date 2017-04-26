<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lektors;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;
use Validator;

class LektorsController extends Controller
{
    //
    //
  public function __construct() {
    $this->middleware('auth');
  }
  
  public function index() {
    return view('admin.lektors.index');
  }
  
  public function create()
  {
      $lektors = new Lektors;
      return view('admin.lektors.edit',['lektors'=>$lektors]);
  }

  public function anyData() {
    return Datatables::of(Lektors::query())->addColumn('action', function ($lektor) {

        $edit = '<a href="/admin/lektors/edit/' . $lektor->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
        if ($lektor->status == 1) {
          $block = '<span id="b' . $lektor->id . '" data-id="' . $lektor->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        } else {
          $block = '<span id="b' . $lektor->id . '" data-id="' . $lektor->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        }

        $delete = ''; //'<a href="#edit-' . $user->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        return $edit . ' ' . $block . ' ' . $delete;
      })->addColumn('status', function($lektor) {
        $status = ($lektor->status == 1) ? "<span id='s" . $lektor->id . "'>Активный</span>" : "<span id='s" . $lektor->id . "' >Заблокирован</span>";
        return $status;
      })->addColumn('image',function($lektor)
        {
           $image = ($lektor->image)&&(File::exists(public_path($lektor->image)))? "<img src='$lektor->image' alt='logo' width='150px' >":"";
           return $image;
        })->make(true);
  }

  public function edit($id) {

    $lektors = Lektors::find($id);

    if ($lektors == null) {
      return view('errors.404', ['message' => 'Lektor not found']);
    }

    return view('admin.lektors.edit', ['lektors' => $lektors]);
  }

  public function update(Request $request) {
//dump($request);
    $id = $request->input('id', '');

    $validator = Validator::make($request->all(), [
        'description' => 'required|max:3000',
        'name_surname' => 'required|string|max:1024',
    ]);

    if ($validator->fails()) {
      if ($id)
      {
        return redirect('admin/lektors/edit/' . $id)
            ->withErrors($validator)
            ->withInput();
      }
      else
      {
        return redirect('admin/lektors/create/')
            ->withErrors($validator)
            ->withInput();
      }
      
    }

    if ($id)
    {
      $lektors = Lektors::find($id);
      $lektors->update($request->except('_token'));
    }
    else
    {
      $r = $request->except('_token');
      
      $lektors = Lektors::create($r);
    }
    
    //ppr($r);
    //ppre($brand);
    
    return redirect('/admin/lektors');
  }

  public function change_status(Request $request) {
    $res = [];
    $id = $request->input('lektor_id');
    $lektor = Lektors::find($id);

    if (!($lektor == null)) {
      if ($lektor->status == 1) {
        $block_button = '<span id="b' . $lektor->id . '" data-id="' . $lektor->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        $status = "<span id='s" . $lektor->id . "' >Заблокирован</span>";
        $lektor->status = 2;
      } else {
        $block_button = '<span id="b' . $lektor->id . '" data-id="' . $lektor->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        $status = "<span id='s" . $lektor->id . "'>Активный</span>";
        $lektor->status = 1;
      }
      $lektor->save();
      $res = ['res' => 'ok', 'block_button' => $block_button, 'status' => $status];
    } else {
      $res = ['res' => 'error', 'message' => 'Error : User not found'];
    }

    return json_encode($res);
  }
}
