<!DOCTYPE html>

<html lang="en">
    
   @section('htmlheader')
   @include('layouts.trainingPartials.htmlheader')
@show 
<body>
        @include('layouts.trainingPartials.bodyheader')
    
    
          <header class="event-header">
        <div class="row header-row">
            <div class="col-lg-offset-2 col-md-offset-2 col-lg-4 col-md-4">
                <div class="header-circle">
                  @yield('headercontent')
                </div>
            </div>
        </div>
        </header>
            
        <article class="event-info">
        <h1>Реєстрація на курс з ділового етикету «@yield('name')»</h1>
        <div class="event-date">@yield('date')</div>
        <div>
            @yield('text-content')
             <p>
                Дата та час: <strong>@yield('date') включно, з @yield('time_from') до @yield('time_to')</strong><br>
                Місце проведення: <strong>@yield('place')</strong><br>
                Адреса: <strong>@yield('adress')</strong><br>
                Вартість курсу: <strong>@yield('price-all') грн.</strong> (Попередня оплата обов'язкова)<br>
                Варість одного заняття: <strong>@yield('price-once') грн.</strong><br>
            </p>
        </div>
    </article>
        

        
<!--        уроки    ==========================================================================================================================    -->       
         <article class="event-program">
            <h3>Програма курсу «@yield('name')»</h3>
        <div class="">
       @yield('lessons-content')
        </div>
            <br/>
        <div class="training-note"><strong>Після проходження всього курсу слухачі отримують сертифікати.</strong></div>
    </article>
<!--        уроки    ==========================================================================================================================    -->       
        
<!--        лекторы    ==========================================================================================================================    -->
 <article class="lecturer">
        <h3 class="lecturer-title">ЛЕКТОР</h3>
        <div class="row">
            @yield('lektor-info')
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <div>
                      @yield('lektor-description')
                </div>
            </div>
        </div>
    </article>
<!--        лекторы    ==========================================================================================================================    -->       
        
      
<script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
</script>   
</body>
</html>
