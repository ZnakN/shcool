<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;
use Validator;

class BrandsController extends Controller
{
    //
    //
  public function __construct() {
    $this->middleware('auth');
  }
  
  public function index() {
    return view('admin.brands.index');
  }
  
  public function create()
  {
      $brand = new Brands;
      return view('admin.brands.edit',['brand'=>$brand]);
  }

  public function anyData() {
    return Datatables::of(Brands::query())->addColumn('action', function ($brand) {

        $edit = '<a href="/admin/brands/edit/' . $brand->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
        if ($brand->status == 1) {
          $block = '<span id="b' . $brand->id . '" data-id="' . $brand->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        } else {
          $block = '<span id="b' . $brand->id . '" data-id="' . $brand->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        }

        $delete = ''; //'<a href="#edit-' . $user->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        return $edit . ' ' . $block . ' ' . $delete;
      })->addColumn('status', function($brand) {
        $status = ($brand->status == 1) ? "<span id='s" . $brand->id . "'>Активный</span>" : "<span id='s" . $brand->id . "' >Заблокирован</span>";
        return $status;
      })->addColumn('logo',function($brand)
        {
           $logo = ($brand->logo)&&(File::exists(public_path($brand->logo)))? "<img src='$brand->logo' alt='logo' width='150px' >":"";
           return $logo;
        })->make(true);
  }

  public function edit($id) {

    $brand = Brands::find($id);

    if ($brand == null) {
      return view('errors.404', ['message' => 'Brand not found']);
    }

    return view('admin.brands.edit', ['brand' => $brand]);
  }

  public function update(Request $request) {
    
    $id = $request->input('id', '');

    $validator = Validator::make($request->all(), [
        'name_ru' => 'required|unique:brands|max:2000',
    ]);

    if ($validator->fails()) {
      if ($id)
      {
        return redirect('admin/brands/edit/' . $id)
            ->withErrors($validator)
            ->withInput();
      }
      else
      {
        return redirect('admin/brands/create/')
            ->withErrors($validator)
            ->withInput();
      }
      
    }

    if ($id)
    {
      $brand = Brands::find($id);
      $brand->update($request->except('_token'));
    }
    else
    {
      $r = $request->except('_token');
      
      $brand = Brands::create($r);
    }
    
    //ppr($r);
    //ppre($brand);
    
    return redirect('/admin/brands');
  }

  public function change_status(Request $request) {
    $res = [];
    $id = $request->input('brand_id');
    $brand = Brands::find($id);

    if (!($brand == null)) {
      if ($brand->status == 1) {
        $block_button = '<span id="b' . $brand->id . '" data-id="' . $brand->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        $status = "<span id='s" . $brand->id . "' >Заблокирован</span>";
        $brand->status = 2;
      } else {
        $block_button = '<span id="b' . $brand->id . '" data-id="' . $brand->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        $status = "<span id='s" . $brand->id . "'>Активный</span>";
        $brand->status = 1;
      }
      $brand->save();
      $res = ['res' => 'ok', 'block_button' => $block_button, 'status' => $status];
    } else {
      $res = ['res' => 'error', 'message' => 'Error : User not found'];
    }

    return json_encode($res);
  }
}
