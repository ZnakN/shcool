<!DOCTYPE html>
<html lang="en">
<head>
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Etiquette school - Реєстрація на курс {{$training->meta_title}}</title>
    <meta name="description" content="{{$training->meta_description}}">
    <meta name="keywords" content="{{$training->meta_keywords}}">

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
  <header class="event-header" style="background: url({{$training->image}})50% 100% no-repeat;background-size: cover;" >
        <div class="row header-row">
            <div class="col-lg-offset-2 col-md-offset-2 col-lg-4 col-md-4">
                <div class="header-circle">
                    <div class="header-date">{{ date('j',strtotime($training->begin_date))}}  - {{$end_date}}</div>
                    <div class="header-school-name">Etiquette School</div>
                    <div class="header-event-topic">{{$training->name}}</div>
                    <div class="header-contact">(044) 466-74-76 <br> info@etiqschool.com.ua</div>
                </div>
            </div>
        </div>
    </header>
    
    
     @yield('content')
    
    
    
    
    
    
    
    
    
        <article class="registration-form">
        <h3>Заповніть данні для реєстрації на курс </h3>
        <!-- ============================== form =================================================================================== -->
<!--        form action="/admin/requests/update" method="post" role="form" enctype="multipart/form-data"-->
        <form enctype="multipart/form-data" id="form" >
            
            <div class="row">
                
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 
                 <input type="hidden" name="training_id" id="training_id" value="{{ $training->id }}">
                 <input type="hidden" name="urL" id="urL" value="{{ asset('/update') }}">
                 
                 <input type="hidden" name="urrL" id="urrL" value="{{ asset('/checkCode') }}">
                 
                  <input type="hidden" name="price_val" id="price_val" value="{{$training->full_price}}">
                  <!--input type="hidden" name="price_val2" id="price_val2" value="{{$training->one_price}}"-->
                  
                 
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <label for="PIB">ПІБ <span class="must-filled">*</span></label><label for="PIB" hidden="true" id="errPIB" class="errorValue">Ви не ввели це поле</label><br> 
                    <input type="text" id="name" name="PIB" placeholder="Як до вас звертатися?" class="text-input"><br>
                    <label for="company">Ваша компанія</label><label  hidden="true" id="errcompany_name" class="errorValue">Ви не ввели це поле</label><br>
                    <input type="text" id="company" placeholder="Назва" name="company_name" class="text-input">
                    <br>
                    <div id="lektions_count" >
                    <div class="label-title1"><b>Скільки лекцій Ви плануєте відвідати? <span class="must-filled">*</span></b><label  hidden="true" id="errlessons_to_visit" class="errorValue">Ви не ввели це поле</label></div>
                    
                    
                    <div class="simple-text">Обиріть один або декілька варіантів.</div>
                    
                    <label class="checkbox-label"><input  class="les" type="checkbox" id="full_price"  name="lessons_to_visit" value="Повний курс" data-price='{{$training->full_price}}'  checked > Повний курс</label><br>
                    
                    @foreach($lessons as $i=>$lesson)
                    <label class="checkbox-label"><input class="les lessons" type="checkbox" name="lessons_to_visit" data-price='{{$lesson->price}}'  value="Лекція {{$i+1}}">Лекція {{$i+1}} </label><br>
                   
                    @endforeach
                    
                    <!--label class="checkbox-label"><input class="lessons" type="checkbox" id="another_check" name="lessons_to_visit" value="Інше"> Інше
                        <input type="text" id="other" class="text-input-other">
                    </label-->
                    </div>
                    
                </div>
                
                
                
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <label for="phone">Номер телефону <span class="must-filled">*</span></label><label for="phone" hidden="true" id="errphone_number" class="errorValue">Ви не ввели це поле</label><br> 
                  <input type="tel" id="phone" name="phone_number"  placeholder="+38(0__) ___-__-__"  class="text-input">
                    <br>
                    <label for="scope">Сфера діяльності</label><label  hidden="true" id="errshpere" class="errorValue">Ви не ввели це поле</label><br>
                    <input type="text" id="scope" placeholder="Наприклад, агро, рітейл" name="sphere" class="text-input">  
                    
                    <label class="long-label certificate-label">Чи бажаєте оформити курс лекцій як подарунок?</label>
                    <div class="simple-text">Після оплати та реєстрації Ви отримаєте подарунковий сертифікат та запрошення на курс</div>
                    <input type="radio" name="present" value="1" id="present1"> Так<br>
                    <input type="radio" name="present" value="2" id="present2"> Ні
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <label for="email">E-mail <span class="must-filled">*</span></label><label  hidden="true" id="errE_mail" class="errorValue">Ви не ввели це поле</label><br>
                  <input type="email" id="email" placeholder="Ваш e-mail" name="E_mail" class="text-input">
                    <br>
                    
                    
                </div>
            </div>
        <hr>
            <div class="to-pay">
                <div class="amount-to-pay" >Сума для оплати<br><span><div id="paypaypay">{{$training->full_price}}</div> грн</span></div>
                <label for="promocode" class="indent">Промо-код</label>
                
            
                <input id="promocode" type="text" name="promo" placeholder="Введіть промо-код">
                
                
             
                <button  id="checkCode" class="check-promocode">Перевірити</button>
               
                
                <div class="indent label-title" id="promo_message"  ></div>
               
                <select name="way_to_pay" id="way_to_pay" required> 
                    <option disabled >Виберіть спосіб оплати</option>
                    <option value="cash selected">Готівкою</option>
                    <!--option value="bankCard">Банківською карткою</option-->
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
                        <button type="button" class="close" id="close_dialog"  data-dismiss="modal" aria-label="Close"><img src="{{asset('trainings_images/close.png')}}"></button>
                        <div style="color:dimgray; text-align:center; font-size: 120%;"><p><b>Дякуємо!</b></p></div>
                        <div class="modal-title" id="myModalLabel"><b>Ви зареєструвались на курс «{{$training->name}}»</b></div>
                        <div class="event-date" style="text-align: center;">{{ date('j',strtotime($training->begin_date))}}  - {{$end_date}}</div>
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

$(function()
{
   
   $('.les').click(function()
   {
      if ($(this).hasClass('lessons'))
      {
        $("#full_price").prop('checked', false);
      }
      var p = 0;
      if($("#full_price").is(':checked')) {
        p = $('#price_val').val();
        $('.lessons').prop('checked', false);
      } 
      else 
      {
          
        $('.lessons').each(function()
        {
           if ($(this).is(':checked'))
           {
              $("#full_price").prop('checked', false);
              p = p+parseInt($(this).attr('data-price'));
           }
        })
      }
      
      $('#paypaypay').html(p);
   });
   
});



$("#checkCode").click(function(e)
{
  e.preventDefault(e);
  var  url = $('#urrL').val();
  
                  var sum_all = 0;
                  if($("#full_price").is(':checked')) 
                  {
                      sum_all = $('#price_val').val();
                  }
                  else
                  {
                    $('.lessons').each(function()
                    {
                       if ($(this).is(':checked'))
                       {
                          $("#full_price").prop('checked', false);
                          sum_all = sum_all+parseInt($(this).attr('data-price'));
                       }
                    })
                  }

  
    
     $.ajax({
               method:'POST',
               url:url,
               headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
               data:{
                   promo_code:$('#promocode').val(),
                   id:$('#training_id').val()
                    
                },
             beforeSend: function (xhr) {
//            var token = $('meta[name="csrf_token"]').attr('content');
//        if (token) {
//                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
       },
              success:function(data){
                if(data.error =='no')
                  {
                  console.log(data.error);
                  console.log(data.message);
                  console.log(data.discount);
                 
                  $("#promo_message").css("color", "green");
                  $("#promo_message").html(data.message);
                  
                                    
                  
                  var sum =  (sum_all - ((sum_all/100)*data.discount)).toFixed(2);
                  // console.log(sum);
                  $("#paypaypay").html(sum);
                  
                  }
                  else
                  {
                  console.log('error');
                  console.log('message');
                  $("#paypaypay").html(sum_all);
                  
                  $("#promo_message").css("color", "red");
                  $("#promo_message").html('Промо-код не дійсний, можливо ви зробили помилку');
                  $("#promo_message").show();
                  }
              },
              error:function(data) { 
                alert('error');
              }      
          });
});           
        
        
        
        
$("#form").submit(function(e)
{
        
 e.preventDefault(e);
 $('#name').css("border-color", "#e0e0e0"); 
 $('#company').css("border-color", "#e0e0e0");
 $('#email').css("border-color", "#e0e0e0"); 
 $('#phone').css("border-color", "#e0e0e0");
 $('#wishes').css("border-color", "#e0e0e0");
 $('#scope').css("border-color", "#e0e0e0");
 $('#other').css("border-color", "#e0e0e0");
 $("#way_to_pay").css("border-color", "#e0e0e0");
 $("#lektions_count").css("border", "none");

 
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
      
      
      var a = 0;
    if($('#name').val()=='') {  $('#name').css("border-color", "red");   a=1;   }
    //if($('#company').val()=='') { $('#company').css("border-color", "red");  a=1; }   
    if($('#email').val()=='') { $('#email').css("border-color", "red");     a=1; }
    if($('#phone').val()=='') { $('#phone').css("border-color", "red");    a=1;  }     
    //if($('#wishes').val()=='') { $('#wishes').css("border-color", "red");   a=1; }
    //if($('#scope').val()=='') {  $('#scope').css("border-color", "red");    a=1; }    
    if(lessons_to_visit=='') {  $("#lektions_count").css("border", "1px solid red");     a=1;   }
    if(way_to_pay=='Виберіть спосіб оплати') { $("#way_to_pay").css("border-color", "red");  a=1; }
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
                    //company_name:$('#company').val(),
                    phone_number:$('#phone').val(),
                    E_mail:$('#email').val(),
                    training_id:$('#training_id').val(),
                    //wishes:$('#wishes').val(),
                    present: $('input[name=present]:checked', '#form').val(),
                    //sphere:$('#scope').val(),
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
                  
                    if(data.message=='Промо-код не дійсний, можливо ви зробили помилку')
                    {
                      $("#promo_message").css("color", "red");
                      $("#promo_message").html('Промо-код не дійсний, можливо ви зробили помилку');
                      $("#promo_message").show();
                      $("#paypaypay").html($('#price_val').val());
                    }
                 else
                    {
                      $('#globalError').show();
                      $('#globalError').html(data.message);
                    }
                  }
                  else
                  {
                  console.log(data.error);
                  console.log(data.message);
                  console.log(data.discount);
                  if(data.discount !='')
                  {
                  $("#promo_message").css("color", "green");
                  $("#promo_message").html('Промо-код дійсний');
                  }
                  
                  var sum_all = 0;
                  if($("#full_price").is(':checked')) 
                  {
                      sum_all = $('#price_val').val();
                  }
                  else
                  {
                    $('.lessons').each(function()
                    {
                       if ($(this).is(':checked'))
                       {
                          $("#full_price").prop('checked', false);
                          sum_all = sum_all+parseInt($(this).attr('data-price'));
                       }
                    })
                  }
                  
                  
                  var sum =  (sum_all - ((sum_all/100)*data.discount)).toFixed(2);
                  // console.log(sum);
                  $("#paypaypay").html(sum);
                  
                  $('#openModal').click();
                  }

              },
              error:function(data) { 
                  var errors = data.responseJSON;
                  console.log(errors);
    }      
    
    
          });
 }
 
 $('#close_dialog').click(function()
 {
   location.reload();
 });
 
});
        
        
       
    </script>
</body>
</html>