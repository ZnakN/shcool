<?php

namespace App\Http\Controllers\Admin;

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
use PHPExcel; 
use PHPExcel_IOFactory;

class RequestsController extends Controller
{
     public function __construct() {
    $this->middleware('auth');
  }
  
  public function index() {
    return view('admin.requests.index');
  }
  
  public function create()
  {
//      $training = new Trainings;
//      $lektors = DB::table('Lektors')->select('name_surname', 'id')->get();
//    
//      return view('admin.trainings.edit',['trainings'=>$training, 'lektors'=>$lektors]);
  }

  
  // обработка запроса на ajax с index.blade.php
  public function anyData() {
   

   return Datatables::of(Requests::query())
            ->addColumn('action', function ($request) {

        $edit = '<a href="/admin/requests/edit/' . $request->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Подробнее</a>';
        if ($request->status == 1) {
          $block = '<span id="b' . $request->id . '" data-id="' . $request->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        } else {
          $block = '<span id="b' . $request->id . '" data-id="' . $request->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        }

        $delete = ''; //'<a href="#edit-' . $user->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        return $edit . ' ' . $block . ' ' . $delete;
      })->addColumn('status', function($request) {
        $status = ($request->status == 1) ? "<span id='s" . $request->id . "'>Активный</span>" : "<span id='s" . $request->id . "' >Заблокирован</span>";
        return $status;
      })
//      ->addColumn('present', function($request) {
//        $status = ($request->present == 1) ? "<span id='s" . $request->present . "'>Да</span>" : "<span id='s" . $request->present. "' >Нет</span>";
//        return $status;
//      })
              ->addColumn('payed', function($request) {
        $status = ($request->payed == 1) ? "<span id='s" . $request->payed . "'>Да</span>" : "<span id='s" . $request->payed. "' >Нет</span>";
        return $status;
      })
//              ->addColumn('discount', function($request) {
//        $status = ($request->discount == 1) ? "<span id='s" . $request->discount . "'>Да</span>" : "<span id='s" . $request->discount. "' >Нет</span>";
//        return $status;
//    })
            ->addColumn('training_id', function($request) {
        $trainings = DB::table('Trainings')->select('name', 'id')->get();
        for ($i=0; $i<count($trainings); $i++)
        {
            if($request->training_id == $trainings[$i]->id)
            {
        $training_name = "<span>{$trainings[$i]->name}</span>" ;
            }
        }    
        return $training_name;
      })->make(true);
      
              

             
 }

  public function edit($id) {

    $requests = Requests::find($id);
     if ($requests == null) {
      return view('errors.404', ['message' => 'Request not found']);
    }
     $trainings = DB::table('Trainings')->select('name', 'id')->get();
        for ($i=0; $i<count($trainings); $i++)
        {
            if($requests->training_id == $trainings[$i]->id)
            {
        $training_name = $trainings[$i]->name ;
            }
        }
 return view('admin.requests.edit',['requests'=>$requests, 'trainings'=> $training_name]);
    //return view('admin.trainings.edit', ['trainings' => $trainings]);
  }

  public function update(Request $request) {
   
    $id = $request->input('id', '');
//dump($request);
    $res = [];
    
    $validator = Validator::make($request->all(), [
        'PIB' => 'required|string|max:1024',
        'company_name' =>'required|string|max:1024',
        'sphere' =>'required|string|max:2048',
        'E_mail' => 'required|string|max:1024',
        'phone_number' => 'required|string|max:1024',
        'lessons_to_visit' => 'string|max:2048',
        'promo' => 'string|max:2048',
        'wishes' => 'required|string|max:2048',
    ]);

    if ($validator->fails()) {
      if ($id)
      {
        return redirect('admin/requests/edit/' . $id)
            ->withErrors($validator)
            ->withInput();
      }
      else
      {
        //$res = ['res' => 'error', 'message' => 'Ви ввели некоректні дані!'];
        return response()->json(array('error' => 'yes', 'message' => 'Ви ввели некоректні дані!'), 200);
      }
      
    }
    else { $res = ['res' => 'ok', 'message' => 'Все добре!'];    }

    if ($id)
    {
      $Requests = Requests::find($id);
      $Requests->update($request->except('_token'));
       return redirect('/admin/requests');
    }
    else
    {
      $r = $request->except('_token');
      
      $Requests = Requests::create($r);
      //return json_encode($res);
      return response()->json(array('error' => 'no', 'message' => 'Все добре!'), 200);
    }
    
    //ppr($r);
    //ppre($brand);
    
    return back();
  }
  
//  public function test()
//  {
//      
//     $res['status'] = 'ok';
//     $res['message'] ='';
//     return json_encode($res);
//      
//  }
  
  

  public function change_status(Request $request) {
    $res = [];
   
    $id = $request->input('requests_id');
    $requests = Requests::find($id);

    if (!($requests == null)) {
      if ($requests->status == 1) {
        $block_button = '<span id="b' . $requests->id . '" data-id="' . $requests->id . '"  class="btn btn-xs btn-success block"><i class="glyphicon glyphicon-ok"></i> Активировать</span>';
        $status = "<span id='s" . $requests->id . "' >Заблокирован</span>";
        $requests->status = 2;
      } else {
        $block_button = '<span id="b' . $requests->id . '" data-id="' . $requests->id . '"   class="btn btn-xs btn-warning block"><i class="glyphicon glyphicon-remove"></i> Заблокировать</span>';
        $status = "<span id='s" . $requests->id . "'>Активный</span>";
        $requests->status = 1;
      }
      $requests->save();
      $res = ['res' => 'ok', 'block_button' => $block_button, 'status' => $status];
    } else {
      $res = ['res' => 'error', 'message' => 'Error : User not found'];
    }

    return json_encode($res);
  }
     
  public function viewExport() {
        $requests = Requests::all();
       return view('admin.exportExcel.viewExport')->with(['requests' =>$requests]);
  }

  public function makeExport() {
       $requests = Requests::all();


$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Admin") 
                             ->setTitle("Заявки")
                             ->setSubject("Office 2007 XLSX  Document")
                             ->setDescription("Просмотр заявок.")
                             ->setKeywords("office 2007  php")
                             ->setCategory("Заявки");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id')
            ->setCellValue('B1', 'Имя фамилия отчество')
            ->setCellValue('C1', 'Название фирмы')
            ->setCellValue('D1', 'Номер телефона')
            ->setCellValue('E1', 'E_mail')
            ->setCellValue('F1', 'Тренинг')
            ->setCellValue('G1', 'Статус')
            ->setCellValue('H1', 'Пожелания')
            ->setCellValue('I1', 'Подарок')
            ->setCellValue('J1', 'Сфера деятельности')
            ->setCellValue('K1', 'Какие уроки посетить')
            ->setCellValue('L1', 'Оплачено')
            ->setCellValue('M1', 'Скидка')
            ->setCellValue('N1', 'Промо-код')
            ->setCellValue('O1', 'Способ оплаты')
        ;

for ($i = 2; $i<=count($requests)+1; $i++)
{
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A{$i}", $requests[$i-2]->id)
            ->setCellValue("B{$i}", $requests[$i-2]->PIB)
            ->setCellValue("C{$i}", $requests[$i-2]->company_name)
            ->setCellValue("D{$i}", $requests[$i-2]->phone_number)
            ->setCellValue("E{$i}", $requests[$i-2]->E_mail)         
            ->setCellValue("F{$i}", $requests[$i-2]->training_id)
            ->setCellValue("G{$i}", $requests[$i-2]->status)           
            ->setCellValue("H{$i}", $requests[$i-2]->wishes)
            ->setCellValue("I{$i}", $requests[$i-2]->present)
            ->setCellValue("J{$i}", $requests[$i-2]->sphere)
            ->setCellValue("K{$i}", $requests[$i-2]->lessons_to_visit) 
            ->setCellValue("L{$i}", $requests[$i-2]->payed)
            ->setCellValue("M{$i}", $requests[$i-2]->discount)
            ->setCellValue("N{$i}", $requests[$i-2]->promo)
            ->setCellValue("O{$i}", $requests[$i-2]->way_to_pay)           
                    ;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="RequestsExcel.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output'); 
//return true;
  }


  
}
