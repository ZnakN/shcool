@extends('layouts.index')

@section('content')

<div class="lectors">
      <div class="container">
        <div class="logo-container">
          <h2 class="logo">Etiquette School</h2>
          <h3 class="topic">Наші лектори</h3>
        </div>
          @foreach($lektors as $lektor)
        <div class="row lectors__row">
          <div class="col-md-4 col-center-content">
            <img src="{{$lektor->image}}" alt="{{$lektor->name_surname}}" style="border-radius: 50%; height:260px; width:260px;">
            <h4 class="lectors__name">{{$lektor->name_surname}}</h4>
          </div>
          <div class="col-md-8">
            {{strip_tags($lektor->description)}}
          </div>
        </div>
          @endforeach
          
        
      </div>
    </div><!--

-->    <div class="profit">
      <div class="container">
        <div class="logo-container profit__logo-container">
          <h2 class="logo">ES</h2>
        </div>
        <p class="profit__text--bordered">надихне почуватися комфортно у будь-якому оточені та знаходити спільну мову з різними людьми.</p> 
        <div class="logo-container profit__logo-container">
          <h2 class="logo">ES</h2>
        </div>
        <p class="profit__text--bordered">навчить правильно підкреслювати ваш успіх та розповідати про ваші досягнення</p>
        <div class="logo-container profit__logo-container">
          <h2 class="logo">ES</h2>
        </div>
        <p class="profit__text--bordered">допоможе помічати важливі деталі та правильно розставляти акценти у спілкуванні.</p> 
        <p class="profit__text--bordered">Ви помітите зміни у собі і зможете надихнути на них ваших близьких.</p>
      </div>	




<div id="app">
<div class="timetable">
  <div class="container">
    <div class="logo-container">
      <h2 class="logo">Etiquette School</h2>
      <h3 class="topic">найближчі тренінги</h3>
    </div>
       
    <table class="table-responsive table-striped timetable__table">
<!--      <tr>
        <td>Індивідуальні заняття</td>
        <td><a href="http://goo.gl/forms/OCw3DCm9YT" target="_blank" class="btn" role="button">Реєстрація</a></td>
      </tr>
      <tr>
        <td>Корпоративний тренінг для компанії</td>
        <td><a href="https://goo.gl/forms/P6bxxjG3KN2PFEHF2" target="_blank" class="btn" role="button">Реєстрація</a></td>
      </tr>
      -->
      @foreach($trainings as $training)
      <tr>
      <td><div class="table-date">{{ date('j',strtotime($training->begin_date))}}  - {{ date('j F',strtotime($training->end_date))}}</div> 
           @for ($i = 0; $i < count($lektors); $i++)
          @if($lektors[$i]->id == $training->id) 
          {{$lektors[$i]->name_surname}}
          @endif
          @endfor

          «{{$training->name}}» <div class="table-subtext">{{$training->type}}</div></td>
      <td><a href="/viewTraining/{{$training->url}}" target="_blank" class="btn" role="button">Детальніше</a></td>
      </tr>
      @endforeach 
      
<!--      <tr>
        <td><div class="table-date">18 квітня</div> Фарід Сафаров «Тонкощі успішних переговорів» <div class="table-subtext">майстер-клас</div></td>
        <td><a href="http://schastiehub.com/events/farid-safarov-tonkosti-uspeshnyh-peregovorov/" target="_blank" class="btn" role="button">Реєстрація</a></td>
      </tr>
      <tr>
        <td><div class="table-date">26 квітня - 17 травня</div> «Совсем другой разговор! Правила успешных переговоров» <div class="table-subtext">курс</div></td>
        <td><a href="https://goo.gl/forms/zR73m2W0luqj7j9r2" target="_blank" class="btn" role="button">Реєстрація</a></td>
      </tr>				<tr>
        <td><div class="table-date">24 квітня – 27 квітня</div> Діловий етикет«Етикет знає як» <div class="table-subtext">інтенсивний курс</div></td>
        <td><a href="https://goo.gl/forms/Ybx8RURb9b1v93Wc2" target="_blank" class="btn" role="button">Реєстрація</a></td>
      </tr>
      <tr>
        <td><div class="table-date">16 травня – 27 травня</div> Ораторське мистецтво «Майстерність публічних виступів»
          <div class="table-subtext">курс</div></td>
        <td><a href="https://goo.gl/forms/Npz6E6ElqvdC5Jvv2" target="_blank" class="btn" role="button">Реєстрація</a></td>
      </tr>
      <tr>
        <td><div class="table-date">17 травня – 18 травня</div> Ресторанний етикет «Покажи мені етикет» <div class="table-subtext">дводенний курс</div></td>
        <td><a href="https://goo.gl/forms/5aQCnnv0wp23hatq1" target="_blank" class="btn" role="button">Реєстрація</a></td>
      </tr>-->
    </table>	
  </div>	
</div>
</div>
@endsection
