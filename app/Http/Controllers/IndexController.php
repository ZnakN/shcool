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
use App\Models\Discounts;
use App\Models\Lessons;
use App\Models\Requests;
use App\Mail\cash;  
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use View;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller {

  //put your code here





  public function index() {
    $trainings = Trainings::select(['id', 'name', 'begin_date', 'end_date', 'url', 'type', 'lektor_id', 'is_static'])->where(['status' => 1])->orderBy('is_static', 'asc')->get();
    $lektors = Lektors::select()->get(['id', 'name_surname', 'description', 'image']);
    //  dump($trainings); 
//       , 'end_date'=> $end_date

    for ($i = 0; $i < count($trainings); $i++) {
      $trainings[$i]->end_date = strtotime($trainings[$i]->end_date);
      $trainings[$i]->end_date = new Date($trainings[$i]->end_date);
      $trainings[$i]->end_date = $trainings[$i]->end_date->format('j F');
    }
    return view('index')->with(['trainings' => $trainings, 'lektors' => $lektors]);
  }

  public function viewDetails($url) {

    $training = Trainings::where('url', $url)->first();
    if ($training == null) {
      return view('errors.404', ['message' => 'Training not found']);
    }
    $lessons = DB::table('lessons')->where('training_id', $training->id)->where('status', 1)->get();

    $lektors = DB::table('lektors')->where('id', $training->lektor_id)->get();
    $all_lektors = DB::table('lektors')->get();
    // $lektor = $lektors[0];  //->name_surname
    // dump($lessons);
//    View::composer('layouts.training', function($view)
//{
//    $view->with('training', $training);
//});
    $timestamp = strtotime($training->end_date);
    $end_date = new Date($timestamp);
    $end_date = $end_date->format('j F');
    // $end_date = strtotime($end_date);
    //$teststr =  strstr($end_date, ' ', true);
    //$teststr[0] =  strtoupper($teststr[0]);
    return view('training', ['training' => $training, 'lektor' => $lektors, 'lessons' => $lessons, 'end_date' => $end_date, 'all_lektors' => $all_lektors]);
  }

  public function update(Request $request) {
    $summ_to_pay = 0;
    $id = $request->input('id', '');
//dump($request);
    $res = [];
    $a = 0;
    $disc = '';
    $validator = Validator::make($request->all(), [
        'PIB' => 'required|string|max:1024',
        'company_name' => 'string|max:1024',
        'sphere' => 'string|max:2048',
        'E_mail' => 'required|email|max:1024',
        'phone_number' => 'required|string|max:1024',
        'lessons_to_visit' => 'string|max:2048',
        'promo' => 'string|max:2048',
        //'wishes' => 'required|string|max:2048',
    ]);

    if ($validator->fails()) {
      
        //$res = ['res' => 'error', 'message' => 'Ви ввели некоректні дані!'];
        return response()->json(array('error' => 'yes', 'message' => 'Ви ввели некоректні дані!'), 200);
      
    } else
    {
      if ($request->input('promo') != '') 
        {
          $discounts = Discounts::select(['id', 'training_id', 'code', 'value', 'status'])->where('code', $request->input('promo'))->where('status', 1)->first();
          if ($discounts != null) {
            $a = 1;
            $disc = $discounts->value;
            $discountWhere = Discounts::find($discounts->id);
            $discountWhere->count--;
            $discountWhere->save();
            if ($discountWhere->count == 0) {
              $discountWhere->status = 2;
              $summ_to_pay = round($request->input('summ_to_pay') - (($request->input('summ_to_pay') / 100)) * $disc);
            }

            $discountWhere->save();
          }

          if ($a != 1) {
            return response()->json(array('error' => 'yes', 'message' => 'Промо-код не дійсний, можливо ви зробили помилку'), 200);
          }
        } else {
          $res = ['res' => 'ok', 'message' => 'Все добре!'];
        }

      $r = $request->except('_token');

      $r = Requests::create($r);

      if ($disc != '') {
        $r->discount_value = $disc;
        $r->save();
      }  
      
      $r->summ_to_pay = ($summ_to_pay)?$summ_to_pay: $request->input('summ_to_pay');
      $r->save();
      
        
      
      
      $send_link = '';
      if ($request->input('action','')=='card')
      {
         $mas = ['o'=>$r->id,'a'=>$r->summ_to_pay];
         
         //ppre($mas);
         
         $send_link = 'https://test-user.tachcard.com/ru/shop/test?a='.$r->summ_to_pay.'&o='.$r->id.'&s='.$this->makeSign($mas);
      }
      else
      {
           $this->send_letter($r, 1);
      }
    }
      //return json_encode($res);

   // $r = Requests::find(9);
   
    
    
    
      return response()->json(array('error' => 'no', 'message' => 'Все добре!', 'discount' => $disc,'send_link'=>$send_link), 200);
    

    //ppr($r);
    //ppre($brand);

    return back();
  }

  public function checkCode(Request $request) {

    $id = $request->input('id', '');
    $promo = $request->input('promo_code', '');
    //->where('training_id', $id)
    $discounts = Discounts::select(['id', 'training_id', 'code', 'value', 'status'])->where('code', $promo)->where('status', 1)->first();

    if ($discounts != null) {
      return response()->json(array('error' => 'no', 'message' => 'Промо-код дійсний', 'discount' => $discounts->value), 200);
    } else {
      return response()->json(array('error' => 'yes', 'message' => 'Промо-код не дійсний', 'id' => $id, 'promo' => $promo, 'discount' => 0), 200);
    }
  }

  private function makeSign($args) {
    $secret_key = 'bacae06eb6eaa338a82eca829120b6b7';
    ksort($args);
    $sign = substr(md5(join(';', $args) . ';' . $secret_key), 0, 8);
    return $sign;
  }
  
  public function pay_response(Request $r)
  {
     
     $id = $r->json('id','');
     $order_id = $r->json('order_id','');
     $amount = $r->json('amount','');
     $d_sd = $r->json('send_date','');
     $d_cr = $r->json('created_at','');
     $sign = $r->json('sign','');
     
     if ($id&&$order_id&&$amount&&$d_sd&&$d_cr&&$sign)
     {
       // проверка подписи
       $ps = [$order_id,$d_sd,$d_cr,$amount];
       $check_sign = $this->makeSign($ps);
       if ($check_sign == $sign)
       {
         $request = Requests::find($order_id);
         if ($request)
         {
            $request->payed = 1;
            $request->save();
            if($request->prepay == 1)
            {
                $this->send_letter($request, 3);
            }
            else
            {
            $this->send_letter($request, 2);
            }
         }
       }
     }
      
     
     
  }
  
  public function pay_ok(Request $r)
  {
       
    return view('mail.card');
  }
  
  public function pay_error(Request $r)
  {
    $request_id = $r->get('order_id', '');
    if($request_id)
    {
        
        $req = Requests::find($request_id);
        if($req)
        {
            $this->send_letter($req, 4);
             return view('mail.cardfail');
        }
        else
        {
            return view('errors.404', ['message' => 'Not found']);
            // 404
        }
    }
    else
    {
         return view('errors.404', ['message' => 'Not found']);
        // відправити на 404
    }
    
  }
  
  public function test()
  {
      $r = Requests::find(9);
      echo $this->send_letter($r, 1).'<br><br>';
      echo $this->send_letter($r, 2) . '<br><br>';
      echo $this->send_letter($r, 3) . '<br><br>';
      echo $this->send_letter($r, 4) . '<br><br>';
  }
  
  
  private function send_letter(Requests $r,$type)
  {
    switch ($type) {
      case '1':
        $message = "Добрий день!<br>
        Ви зареєструвалися на курс - ".$r->training->name." (".date('d.m.Y',strtotime($r->training->begin_date))." - ". date('d.m.Y', strtotime($r->training->end_date)) ." ).<br>
        Для підтвердження участі необхідно здійснити попередню оплату.<br>
        Вартість курсу ".$r->summ_to_pay." грн.<br>
        Для здійснення оплати найближчим часом з вами зв'яжеться менеджер.<br>
        <br>
        Раді відповісти на всі ваші запитання за номером (067) 466 74 76<br>
        Ваша Etiquette School
        ";
    //    Mail::to($r->E_mail)->send(new \App\Mail\cash($message));
         Mail::to($r->E_mail)->send(new cash($message));
      break;
      
    case '2':
        $message = "Добрий день!<br>
        Ви зареєструвалися  і оплатили курс - " . $r->training->name . " (" . date('d.m.Y', strtotime($r->training->begin_date)) . " - " . date('d.m.Y', strtotime($r->training->end_date)) . " ).<br>
        Чекаємо Вас ". date('d.m.Y', strtotime($r->training->begin_date)) ." ".$r->training->time_from."<br>
        за вдресою " . $r->training->adress_where." ". $r->training->adress . " .<br>
        <br>
        Раді відповісти на всі ваші запитання за номером (067) 466 74 76<br>
        Ваша Etiquette School
        ";
         Mail::to($r->E_mail)->send(new cash($message));
        break;

      case '3':
        $message = "Добрий день!<br>
        Ви зареєструвалися на курс - " . $r->training->name . " (" . date('d.m.Y', strtotime($r->training->begin_date)) . " - " . date('d.m.Y', strtotime($r->training->end_date)) . " ).<br>
        Для підтвердження участі необхідно здійснити попередню оплату.<br>
        Вартість курсу " . $r->summ_to_pay . " грн.<br>
        Для здійснення оплати найближчим часом з вами зв'яжеться менеджер.<br>
        <br>
        Раді відповісти на всі ваші запитання за номером (067) 466 74 76<br>
        Ваша Etiquette School
        ";
           Mail::to($r->E_mail)->send(new cash($message));
        break;
      
      case '4':
        $message = "Добрий день!<br>
        Ви зареєструвалися на курс - " . $r->training->name . " (" . date('d.m.Y', strtotime($r->training->begin_date)) . " - " . date('d.m.Y', strtotime($r->training->end_date)) . " ).<br>
        На жаль ваша оплата не пройшла успішно.<br>
        Ви можете спробувати зареєтруватися та оплатити ще раз на сайті <br> 
        www.etiqschool.com.ua або пропонуємо вам альтернативний варіант оплати:<br>
        оплата на карту в найближчому терміналі ПриватБанку 5168 7555 2854 8379 Зубкова Е.О<br>
        Вартість курсу " . $r->summ_to_pay . " грн.<br>
        <br>
        Раді відповісти на всі ваші запитання за номером (067) 466 74 76<br>
        Ваша Etiquette School
        ";
           Mail::to($r->E_mail)->send(new cash($message));
        break;



      default:
        break;
    }
    
    
    
    
    
    return $message;
  }
  
  
  
  
}