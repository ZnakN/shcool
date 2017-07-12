  @extends('layouts.training',  ['training' => $training, 'lessons'=>$lessons])

@section('content')
<article class="event-info">
        <h1>{{$training->internal_title}}</h1>
        <div class="event-date">{{ date('j',strtotime($training->begin_date))}}  - {{ date('j F',strtotime($training->end_date))}}</div>
        <div>
           {{$training->name}}
                Дата та час: <strong>{{ date('j',strtotime($training->begin_date))}}  - {{ date('j F',strtotime($training->end_date))}} включно, з {{ date('H:i',strtotime($training->time_from))}} до {{date('H:i',strtotime($training->time_to))}}</strong><br>
                Місце проведення: <strong>{{$training->adress_where}}</strong><br>
                Адреса: <strong>{{$training->adress}}</strong><br>
                Вартість курсу: <strong>{{$training->full_price}} грн.</strong> (Попередня оплата обов'язкова)<br>
                Варість одного заняття: <strong>{{$training->one_price}} грн.</strong><br>
              
        </div>
    </article>
@if($training->is_static!=1)
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
                       {{strip_tags($lessons[$j]->description)}}
                    </div>
                </div>
           @endif
  @endfor
   </div>
  @endfor
        </div>
        <div class="training-note"><strong>Після проходження всього курсу слухачі отримують сертифікати.</strong></div>
        
        
    </article>
@endif
    <article class="lecturer">
        <h3 class="lecturer-title">ЛЕКТОР</h3>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="photo-wrap"><img src="{{$lektor[0]->image}}" alt="{{$lektor[0]->name_surname}}" style="border-radius: 50%; height:260px; width:260px;"> </div>
                <div class="lecturer-name">{{$lektor[0]->name_surname}}</div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <div>
                   {{strip_tags($lektor[0]->description)}}
                </div>
            </div>
        </div>
    </article>
<?php echo Session::get('message');?>
@endsection