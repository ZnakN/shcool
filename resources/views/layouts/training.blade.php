<!DOCTYPE html>
<html lang="en">
<head>
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Реєстрація на курс з ділового етикету «Етикет знає як»</title>

    <link href="{{ asset('/css/trainings_css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/trainings_css/main.css') }}"/>

    <style>
        .errorValue{ color:red; }
    </style>
    
</head>
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

<body>
    <header class="event-header">
        <div class="row header-row">
            <div class="col-lg-offset-2 col-md-offset-2 col-lg-4 col-md-4">
                <div class="header-circle">
                    <div class="header-date">{{ date('j',strtotime($training->begin_date))}}  - {{ date('j F',strtotime($training->end_date))}}</div>
                    <div class="header-school-name">Etiquette School</div>
                    <div class="header-event-topic">{{$training->name}}</div>
                    <div class="header-contact">(044) 466-74-76 <br> info@etiqschool.com.ua</div>
                </div>
            </div>
        </div>
    </header>
    
    
     @yield('content')
    
    
    
    
    
    
    
    
    
        <article class="registration-form">
        <h3>Заповніть данні для реєстрації на курс</h3>
        <!-- ============================== form =================================================================================== -->
<!--        form action="/admin/requests/update" method="post" role="form" enctype="multipart/form-data"-->
        <form enctype="multipart/form-data" id="form" >
            
            <div class="row">
                
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 
                 <input type="hidden" name="training_id" id="training_id" value="{{ $training->id }}">
                 <input type="hidden" name="urL" id="urL" value="{{ asset('/admin/requests/update') }}">
                 
                 
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <label for="PIB">ПІБ <span class="must-filled">*</span></label><label for="PIB" hidden="true" id="errPIB" class="errorValue">Ви не ввели це поле</label><br> 
                    <input type="text" id="name" name="PIB" placeholder="Як до вас звертатися?" class="text-input red-border"><br>
                    <label for="phone">Номер телефону <span class="must-filled">*</span></label><label for="phone" hidden="true" id="errphone_number" class="errorValue">Ви не ввели це поле</label><br> 
                    <input type="tel" id="phone" name="phone_number"  placeholder="+38(0__) ___-__-__"  class="text-input"><br>
                    <div class="label-title"><b>Скільки лекцій Ви плануєте відвідати? <span class="must-filled">*</span></b><label  hidden="true" id="errlessons_to_visit" class="errorValue">Ви не ввели це поле</label></div>
                    
                    
                    <div class="simple-text">Обиріть один або декілька варіантів.</div>
                    
                    <label class="checkbox-label"><input type="checkbox" name="lessons_to_visit" value="Повний курс"> Повний курс</label><br>
                    
                    @for ($i = 0; $i < count($lessons); $i++)
                    <label class="checkbox-label"><input class="lessons" type="checkbox" name="lessons_to_visit" value="Лекція {{$i+1}}">Лекція {{$i+1}} - {{$lessons[$i]->name}}</label><br>
<!--                    <label class="checkbox-label"><input type="checkbox" name="sum-lectures" value="Лекція 2"> Лекція 2</label><br>
                    <label class="checkbox-label"><input type="checkbox" name="sum-lectures" value="Лекція 3"> Лекція 3</label><br>
                    <label class="checkbox-label"><input type="checkbox" name="sum-lectures" value="Лекція 4"> Лекція 4</label><br>-->
                    @endfor
                    
                    <label class="checkbox-label"><input class="lessons" type="checkbox" id="another_check" name="lessons_to_visit" value="Інше"> Інше
                        <input type="text" id="other" class="text-input-other">
                    </label>
                    
                </div>
                
                
                
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <label for="company">Ваша компанія <span class="must-filled">*</span></label><label  hidden="true" id="errcompany_name" class="errorValue">Ви не ввели це поле</label><br>
                    <input type="text" id="company" placeholder="Назва" name="company_name" class="text-input"><br>
                    <label for="email">E-mail <span class="must-filled">*</span></label><label  hidden="true" id="errE_mail" class="errorValue">Ви не ввели це поле</label><br>
                    <input type="email" id="email" placeholder="Ваш e-mail" name="E_mail" class="text-input"><br>
                    <label for="wishes" class="long-label">Яка назва теми найточніше відобразила би Ваші побажання? <span class="must-filled">*</span></label><label  hidden="true" id="errwishes" class="errorValue">Ви не ввели це поле</label><br>
                    <textarea id="wishes" name="wishes"></textarea>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <label for="scope">Сфера діяльності <span class="must-filled">*</span></label><label  hidden="true" id="errshpere" class="errorValue">Ви не ввели це поле</label><br>
                    <input type="text" id="scope" placeholder="Наприклад, агро, рітейл" name="sphere" class="text-input"><br>
                    <label class="long-label certificate-label">Чи бажаєте оформити курс лекцій як подарунок?</label>
                        <div class="simple-text">Після оплати та реєстрації Ви отримаєте подарунковий сертифікат та запрошення на курс</div>
                    <input type="radio" name="present" value="1" id="present1"> Так<br>
                    <input type="radio" name="present" value="2" id="present2"> Ні
                    
                </div>
            </div>
        <hr>
            <div class="to-pay">
                <div class="amount-to-pay">Сума для оплати<br><span>{{$training->full_price}} грн</span></div>
                <label for="promocode" class="indent">Промо-код</label>
                <input id="promocode" type="text" name="promo" placeholder="Введіть промо-код">
                <input type="submit" value="Перевірити"  class="check-promocode">
                <div class="indent label-title">Промо-код не дійсний, можливо ви зробили помилку</div>
               
                <select name="way_to_pay" id="way_to_pay" required> 
                    <option disabled selected>Виберіть спосіб оплати</option>
                    <option value="cash">Готівкою</option>
                    <option value="bankCard">Банківською карткою</option>
                </select> <label  hidden="true" id="errway" class="errorValue">Ви не вказали спосіб оплати</label><br>
              
<!--                  <input type="submit" class="btn-footer btn btn-primary"  value="Далі" > -->
<!--          type="button"        data-toggle="modal" data-target="#myModal"-->
                <button type="submit" class="btn-footer btn btn-primary"  id="submit" >Далі</button>
                <button hidden="true" type="button"   data-toggle="modal" id="openModal" data-target="#myModal" >Далі</button>
            </div>
        </form>
<p  hidden="true" id="globalError" class="errorValue"></p><br/>
 <!-- =========================== end form ================================================================================== -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{asset('trainings_images/close.png')}}"></button>
                        <div class="modal-title" id="myModalLabel"><b>Ви зареєструвались на курс «Етикет знає як»</b></div>
                        <div class="event-date">24-27 квітня</div>
                    </div>
                    <div class="modal-body">
                        Найближчим часом з Вами зв’яжеться менеджер для узгодження деталей.
                    </div>
                </div>
            </div>
        </div>
        
        
    </article>
    <footer>
            <div class="container">
                <ul class="footer-menu">
                    <li>
                        <div class="logo-container">
                            <span class="header-school-name">ES</span><br>
                            <span class="header-event-topic">label of your success</span>
                        </div>
                    </li>
                    <li><a href="tel:0444667476">044 466 74 76</a><br>
                        <a href="mailto:info@etiqschool.com.ua">info@etiqschool.com.ua</a>
                    </li>
                </ul>
            </div>
    </footer>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/js/jquery.maskedinput.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/js/index.js')}}" type="text/javascript"></script>
        
    <script>
$("#form").submit(function(e)
{
        
 e.preventDefault(e);
 $('#globalError').hide();
  $('#errPIB').hide(); 
    $('#errcompany_name').hide();  
   $('#errE_mail').hide(); 
   $('#errphone_number').hide();  
  $('#errwishes').hide(); 
   $('#errshpere').hide(); 
   $('#errlessons_to_visit').hide(); 
  $('#errway').hide();  
 //url = asset('/admin/requests/update');
 url = $('#urL').val();
 if(($('#promocode').val()!=null)&&($('#promocode').val()!=""))
 {
     
     discount = 1;
 }
 else
 {
     discount = 2;
 }
 
      var way = document.getElementById('way_to_pay');
      var way_to_pay = way.options[way.selectedIndex].text;
      
      var lessons_to_visit='';
      
      var lessons = $('input:checkbox:checked').map(function() {
    return this.value;
}).get();
      
      //lessons = $('.lessons:checkbox:checked');
      
      for (i=0; i<lessons.length; i++)
      {
          lessons_to_visit += lessons[i]+' ';         
      }
      
      if(($('#another_check').is(':checked'))&&$('#another_check').val()=="Інше")
      {
lessons_to_visit = $('#other').val();
      }
   
      var a = 0;
    if($('#name').val()=='') { $('#errPIB').show(); a = 1;  }
    if($('#company').val()=='') { $('#errcompany_name').show(); a = 1;  }   
    if($('#email').val()=='') { $('#errE_mail').show(); a = 1;  }
    if($('#phone').val()=='') { $('#errphone_number').show(); a = 1;  }     
    if($('#wishes').val()=='') { $('#errwishes').show(); a = 1;  }
    if($('#scope').val()=='') { $('#errshpere').show(); a = 1;  }    
    if(lessons_to_visit=='') { $('#errlessons_to_visit').show(); a = 1;  }
    if(way_to_pay=='Виберіть спосіб оплати') { $('#errway').show(); a = 1;  }
        if(a==1)
        {
            
        }
        else
        {
   
   
 
 $.ajax({
               method:'POST',
               url:url,
               headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
               data:{PIB:$('#name').val(),
                    company_name:$('#company').val(),
                    phone_number:$('#phone').val(),
                    
                    E_mail:$('#email').val(),
                    training_id:$('#training_id').val(),
                    wishes:$('#wishes').val(),
                    present: $('input[name=present]:checked', '#form').val(),
                    sphere:$('#scope').val(),
                    lessons_to_visit:lessons_to_visit,
                    promo:$('#promocode').val(),
                    discount:discount,
                    way_to_pay:way_to_pay

                    
                },
             beforeSend: function (xhr) {
//            var token = $('meta[name="csrf_token"]').attr('content');
//        if (token) {
//                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
       },
              success:function(data){
                  if(data.error =='yes')
                  {
                  console.log(data.error);
                  console.log(data.message);
                  $('#globalError').show();
                  $('#globalError').html(data.message);
                  }
                  else
                  {
                  console.log(data.error);
                  console.log(data.message);
                  $('#openModal').click();
                  }

              },
              error:function(data) { 
                  var errors = data.responseJSON;
                  console.log(errors);
    }      
    
    
          });
 }
 
 
 
});
            
            
    </script>
</body>
</html>