<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\cash;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ermail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send error email , if user not make payment after 10 minuts after request.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        DB::enableQueryLog();
        setlocale(LC_ALL, 'ru_RU.UTF-8');

//    $r = DB::table('requests')->where('way_to_pay','=',"Оплата на карту")->where('payed','=',"2")
//        ->where('created_at','<',"(now() - INTERVAL 10 MINUTE)")->where('not_pay','=',"0")->get();
    $req = DB::table('requests')->where('way_to_pay', '=', "Оплата на карту")->where('payed', '=', "2")->
    where('not_pay', '=', "0")->where('created_at', '>', date('Y-m-d H:i:s',(time()-600)))->get();

//    print_r(DB::getQueryLog());
   
    foreach ($req as $r) 
    {
        $request = Requests::find($r->id);
        if ($request)
        {
          $total_summ = $request->summ_to_pay; // при выборке клиентом оплаты частями  - в письме ему указывать полную стоимость курса, а не его часть.
          if ($request->prepay == 1) { // если есть предоплата, находим полную цену тренинга (добавляем + 70%)
          $total_summ = ($request->summ_to_pay * 100) / 30;
          }
          $message = "<h3>Добрий день, " . $request->PIB . "</h3>
        <p>Ви зареєструвалися на курс - " . $request->training->name . " (" . date('d.m.Y', strtotime($request->training->begin_date)) . " - " . date('d.m.Y', strtotime($request->training->end_date)) . " ).</p>
        <p>На жаль ваша оплата не пройшла успішно.</p>
        Ви можете спробувати зареєтруватися та оплатити ще раз на сайті <br> 
        <a href='www.etiqschool.com.ua'>www.etiqschool.com.ua</a> або пропонуємо вам альтернативний варіант оплати:<br>
        плата на карту в найближчому терміналі ПриватБанку 5168 7555 2854 8379 Зубкова Е.О<br>
        <p>Вартість курсу <strong>" . $total_summ . "</strong> грн.</p>
        ";
          
          Mail::to($request->E_mail)->send(new cash($message));
          $request->not_pay=1;
          $request->save();
      }
    }
      
      
      
    }
}
