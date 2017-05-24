  @extends('layouts.training',  ['training' => $training, 'lessons'=>$lessons, 'end_date'=>$end_date])

@section('content')
<article class="event-info">
        <h1>Реєстрація на курс з ділового етикету «{{$training->name}}»</h1>
        <div class="event-date">{{ date('j',strtotime($training->begin_date))}}  - {{ $end_date}}</div>
        <div style="white-space: pre-wrap">
           
            {{strip_tags($training->description)}}
            
        </div></br>
        <div>
<!--           {{$training->name}}-->
                Дата та час: <strong>{{ date('j',strtotime($training->begin_date))}}  - {{ $end_date }} включно, з {{ date('H:i',strtotime($training->time_from))}} до {{date('H:i',strtotime($training->time_to))}}</strong><br>
                Місце проведення: <strong>{{$training->adress_where}}</strong><br>
                Адреса: <strong>{{$training->adress}}</strong><br>
                Вартість курсу: <strong><span id="paypaypay2" >{{$training->full_price}}</span> грн.</strong> (Попередня оплата обов'язкова)</br>
                Варість одного заняття: <strong><span id="paypaypay3">{{$training->one_price}}</span> грн.</strong><br>
                 
<!--                 Date::createFromDate($training->end_date)->format('j-F')-->
            </p>
        </div>
    </article>
    <article class="event-program">
            <h3>Програма курсу «{{$training->name}}»</h3>
        <div class="">
            @for ($i = 0; $i < count($lessons); $i=($i+2))
 <div class="line-wrap row">
 @for ($j = $i; $j <= $i+1; $j++)
    @if($j <= count($lessons)-1)
                <div class="col-xs-12 col-sm-6 col-md-6 col-ld-6">
                    <div class="trainings top-line">
                        <span class="training">Заняття {{$j+1}}: </span><span class="training-topic">{{$lessons[$j]->name}}</span>
                        <br/>
                       {!!$lessons[$j]->description!!}
                    </div>
                </div>
           @endif
  @endfor
   </div>
  @endfor
        </div>
        <div class="training-note"><strong>Після проходження всього курсу слухачі отримують сертифікати.</strong></div>
        
        
    </article>
    <article class="lecturer">
        <h3 class="lecturer-title">ЛЕКТОР</h3>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="photo-wrap"><img src="{{$lektor[0]->image}}" alt="{{$lektor[0]->name_surname}}" style="border-radius: 50%; height:260px; width:260px;"> </div>
                <div class="lecturer-name">{{$lektor[0]->name_surname}}</div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <div style="white-space: pre-wrap">
                   {{strip_tags($lektor[0]->description)}}
                </div>
            </div>
        </div>
    </article>
<?php echo Session::get('message');?>
@endsection