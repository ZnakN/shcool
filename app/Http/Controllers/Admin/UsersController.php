<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\User;

class UsersController extends Controller
{
    //
  public function __construct() {
    $this->middleware('auth');
  }
  
  
  
  public function index()
  {
    return view('admin.users.index');
  }
  
  public function anyData() {
    return Datatables::of(User::query())->addColumn('action', function ($user) {
        
      $edit = '<a href="/admin/users/edit/' . $user->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
      if ($user->status == 1)
      {
        $block = '<span id="b' . $user->id . '" data-id="' . $user->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
      }
      else
      {
          $block = '<span id="b' . $user->id . '" data-id="' . $user->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
      }
      
      $delete = '';//'<a href="#edit-' . $user->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      return $edit.' '.$block.' '.$delete;
          
      })->addColumn('status',function($user){
        $status = ($user->status == 1)? "<span id='s".$user->id."'>Активный</span>":"<span id='s" . $user->id . "' >Заблокирован</span>";
        return $status;
      })->make(true);
  }
  
  public function edit($id)
  {
    
    $user = User::find($id);
    
    if ($user==null)
    {
      return view('errors.404', ['message' => 'User not found']);
    }
    
    return view('admin.users.edit',['user'=>$user]);
  }
  
  public function update(Request $request)
  {
      $id = $request->input('id');
//      $name = $request->input('name');
//      $role = $request->input('role');
//      $status = $request->input('status');
      $user = User::find($id);
      
      $user->update($request->all());
    return redirect('/admin/users');
  }
  
  public function change_status(Request $request)
  {
      $res = [];
      $id = $request->input('user_id');
      $user = User::find($id);
      
      if (!($user == null))
      {
          if ($user->status == 1) {
          $block_button = '<span id="b' . $user->id . '" data-id="' . $user->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
          $status = "<span id='s" . $user->id . "' >Заблокирован</span>";
          $user->status = 2;
        } else {
          $block_button = '<span id="b' . $user->id . '" data-id="' . $user->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
          $status = "<span id='s" . $user->id . "'>Активный</span>";
          $user->status = 1;
        }
        $user->save();
        $res = ['res' => 'ok', 'block_button' => $block_button, 'status' => $status];
      }
      else
      {
         $res = ['res'=>'error','message'=>'Error : User not found']; 
      }
      
      return json_encode($res);
      
  }
  
  
}
