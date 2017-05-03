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
use View;
use Jenssegers\Date\Date;

class ViewController extends Controller
{
     public function __construct() {
    $this->middleware('auth');
  }
  
  public function viewTrainings() {
    return view('admin.view.viewTrainings');
  }
  
  
   public function anyData() {
    return Datatables::of(Trainings::query())->addColumn('action', function ($training) {
        $details = '<a href="/admin/viewTrainings/view/' . $training->url . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Подробно</a>';
        return $details;
      })->addColumn('status', function($training) {
        $status = ($training->status == 1) ? "<span id='s" . $training->id . "'>Активный</span>" : "<span id='s" . $training->id . "' >Заблокирован</span>";
        return $status;
      })->make(true);
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
  
  return view('training.index',['training'=>$training, 'lektor'=>$lektors, 'lessons'=>$lessons]);
  }
   
 
  
  
}
