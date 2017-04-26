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
       $trainings = Trainings::select(['name','status','url'])->get();
     //  dump($trainings);
    return view('index')->with(['trainings' =>$trainings]);
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
  
}