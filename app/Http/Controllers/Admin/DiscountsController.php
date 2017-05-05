<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discounts;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Trainings;

/**
 * Description of DiscountsController
 *
 * @author зс
 */
class DiscountsController extends Controller 
{
  //put your code here
  public function __construct() {

    $this->middleware('auth');
  }
  
  public function index() {
    return view('admin.discounts.index');
  }
  
  public function anyData() {
    return Datatables::of(Discounts::query())->addColumn('status', function($discount) {
        $status = ($discount->status == 1) ? "<span id='s" . $discount->id . "'>Нет</span>" : "<span id='s" . $discount->id . "' >Да</span>";
        return $status;
      })->addColumn('training_id', function($lesson) {

        return $lesson->training->name;
      })->make(true);
  }
  
  public function add()
  {
    $tranings = Trainings::all();
    
    return view('admin.discounts.add',['trainings' => $tranings]);
  }
  
  public function create(Request $request )
  {
      $training_id = $request->input('training_id');
      $value = $request->input('value','');
      $count = $request->input('count',0);
      
      if ($training_id&&$value&&$count)
      {
         for ($i=1;$i<=$count;$i++)
         {
            $dicount = Discounts::create(['training_id' => $training_id, 'value' => $value, 'code' => mt_rand(1000000, 9999999),'status'=>1]);
         }
      }
      return redirect('/admin/discounts');
  }
  
}