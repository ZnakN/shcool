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
     
//    $lektors = DB::table('Lektors')->select('name_surname', 'id')->get();
//    if ($training == null) {
//      return view('errors.404', ['message' => 'Brand not found']);
//    }
// return view('admin.trainings.edit',['trainings'=>$training, 'lektors'=>$lektors]);
   return view('admin.view.viewDetails',['trainings'=>$training]);
  }
   
}
