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
        window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
    </script>

    <body>
        <header class="event-header" style="background: url({{$training->image}})50% 100% no-repeat;background-size: cover;" >
            <div class="row header-row">
                <div class="col-lg-offset-2 col-md-offset-2 col-lg-4 col-md-4">
                    <div class="header-circle">
                        @if($training->is_static!=1)
                        <div class="header-date" style="margin-bottom:0px;">{{ date('j',strtotime($training->begin_date))}}  - {{$end_date}}</div>
                        @endif
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
            <!--<form enctype="multipart/form-data" method="post" action="{{ asset('/checkCodeTest') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input id="promocode" type="text" name="promo" placeholder="Введіть промо-код">
                 <input type="hidden" name="training_id" id="training_id" value="{{ $training->id }}">
                <input type="submit">
            </form>-->


            <form enctype="multipart/form-data" id="form" >

                <div class="row">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="training_id" id="training_id" value="{{ $training->id }}">

                    <input type="hidden" name="summPay" id="summPay" value="{{$training->full_price}}">

                    <input type="hidden" name="urL" id="urL" value="{{ asset('/update') }}">
                    <input type="hidden" name="urrL" id="urrL" value="{{ asset('/checkCode') }}">

                    <input type="hidden" name="price_val" id="price_val" value="{{$training->full_price}}">
  <!--                  <input type="hidden" name="price_val2" id="price_val2" value="{{$training->one_price}}">-->


                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <label for="PIB">ПІБ <span class="must-filled">*</span></label><label for="PIB" hidden="true" id="errPIB" class="errorValue">Ви не ввели це поле</label><br> 
                        <input type="text" id="name" name="PIB" placeholder="Як до вас звертатися?" class="text-input"><br>
                        <label for="company">Ваша компанія</label><label  hidden="true" id="errcompany_name" class="errorValue">Ви не ввели це поле</label><br>
                        <input type="text" id="company" placeholder="Назва" name="company_name" class="text-input">
                        <br>
                        <div id="lektions_count" >
                            @if($training->is_static!=1) 
                            <div class="label-title1"><b>Скільки лекцій Ви плануєте відвідати? <span class="must-filled">*</span></b><label  hidden="true" id="errlessons_to_visit" class="errorValue">Ви не ввели це поле</label></div>
                            @else
                            <div class="label-title1"><b>Оберіть лектора? <span class="must-filled">*</span></b><label  hidden="true" id="errlessons_to_visit" class="errorValue">Ви не ввели це поле</label></div>
                            @endif
                            <div class="simple-text">Обиріть один або декілька варіантів.</div>
                            @if($training->is_static!=1) 
                            <label class="checkbox-label"><input  class="les" type="checkbox" id="full_price"  name="lessons_to_visit" value="Повний курс" data-price='{{$training->full_price}}'  checked > Повний курс</label><br>
                            @endif

                            @if($training->is_static!=1) 
                            @foreach($lessons as $i=>$lesson)
                            <label class="checkbox-label"><input class="les lessons" type="checkbox" name="lessons_to_visit" data-price='{{$lesson->price}}'  value="Лекція {{$i+1}}">Лекція {{$i+1}} </label><br>

                            @endforeach
                            @endif

                            @if($training->is_static==1)
                            @foreach($all_lektors as $i=>$all_lektor)
                            <label class="checkbox-label"><input class="les lessons" type="checkbox" name="lessons_to_visit"   value="{{$all_lektor->name_surname}}"> {{$all_lektor->name_surname}} </label><br>

                            @endforeach
                            @endif
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

                        @if($training->is_static!=1)
                        <label class="long-label certificate-label">Чи бажаєте оформити курс лекцій як подарунок?</label>
                        <div class="simple-text">Після оплати та реєстрації Ви отримаєте подарунковий сертифікат та запрошення на курс</div>
                        <input type="radio" name="present" value="1" id="present1"> Так<br>
                        <input type="radio" name="present" value="2" id="present2"> Ні
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <label for="email">E-mail <span class="must-filled">*</span></label><label  hidden="true" id="errE_mail" class="errorValue">Ви не ввели це поле</label><br>
                        <input type="email" id="email" placeholder="Ваш e-mail" name="E_mail" class="text-input">
                        <br>


                    </div>
                </div>
                <hr>

                <div class="to-pay">
                    @if($training->is_static!=1)
                    <div class="amount-to-pay" >Сума для оплати<br><br><span><span id="paypaypay">{{$training->full_price}} </span> грн</span></div>

                    <label class="checkbox-label"><input class="" type="checkbox" name="prepay"   value="1" id="prepay"> Оплатити предоплатою </label><br>
                    <div id="persent" hidden="true">{{$training->full_price/100}}</div>

                    <input id="promocode" type="text" name="promo" placeholder="Введіть промо-код">



                    <button  id="checkCode" class="check-promocode">Перевірити</button>


                    <div class="indent label-title" id="promo_message"  ></div>

<!--                <select name="way_to_pay" id="way_to_pay" required> 
     <option disabled >Виберіть спосіб оплати</option>
     <option value="cash selected">Готівкою</option>
     option value="bankCard">Банківською карткою</option
 </select> <label  hidden="true" id="errway" class="errorValue">Ви не вказали спосіб оплати</label><br>-->

<!--                  <input type="submit" class="btn-footer btn btn-primary"  value="Далі" > -->
                    <!--          type="button"        data-toggle="modal" data-target="#myModal"-->
                    @else
                    <select name="way_to_pay" id="way_to_pay" required hidden="true"> 
                        <option disabled >Виберіть спосіб оплати</option>
                        <option value="cash selected">Готівкою</option>
                        <!--option value="bankCard">Банківською карткою</option-->
                    </select> <label  hidden="true" id="errway" class="errorValue">Ви не вказали спосіб оплати</label><br>


                    @endif

                    @if($training->is_static!=1)
                    <button type="button" class="btn-footer btn btn-primary bsend"  id="submit" data-action="nal" name="Готівкою" >Оплата готівкою</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn-footer btn btn-primary bsend"  id="submit2" data-action="card" name="Карткою" >Оплата на карту</button>
                    @else

                    <button type="button" class="btn-footer btn btn-primary bsend" data-action="nal_z" id="submit" name="Заявка" >Подати заявку</button>
                    @endif
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

        function pay(action)
        {
            $('#name').css("border-color", "#e0e0e0");
            $('#company').css("border-color", "#e0e0e0");
            $('#email').css("border-color", "#e0e0e0");
            $('#phone').css("border-color", "#e0e0e0");
            $('#wishes').css("border-color", "#e0e0e0");
            $('#scope').css("border-color", "#e0e0e0");
            $('#other').css("border-color", "#e0e0e0");
            $("#way_to_pay").css("border-color", "#e0e0e0");
            $("#lektions_count").css("border", "none");
            // проверка заполненных полей
            var   aaa = false;
            var lessons_to_visit = '';
            
             var lessons = $('input:checkbox:checked').map(function () {
                        return this.value;
                    }).get();
                    for (i = 0; i < lessons.length; i++)
                    {
                        lessons_to_visit += lessons[i] + ' ';
                    }
                    
            var a = 0;
            if ($('#name').val() == '') {
                $('#name').css("border-color", "red");
                a = 1;
            }
            if ($('#email').val() == '') {
                $('#email').css("border-color", "red");
                a = 1;
            }
            if ($('#phone').val() == '') {
                $('#phone').css("border-color", "red");
                a = 1;
            }
            if (lessons_to_visit == '') {
                $("#lektions_count").css("border", "1px solid red");
                a = 1;
            }

            if(a == 1)
            {
                return false;
            }

            // проверка промо-кода
            var discount = 0;
            if (($('#promocode').val() != null) && ($('#promocode').val() != ""))
            {

                $.ajax({
                    method: 'POST',
                    url: "/checkCode",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        promo_code: $('#promocode').val(),
                        id: $('#training_id').val()

                    },
                    async: false,
                    success: function (res)
                    {
                        if (res.error == 'no')
                        {
                            $("#promo_message").css("color", "green");
                            $("#promo_message").html(res.message);
                            discount = 1;
                        } else
                        {
                            $("#promo_message").css("color", "red");
                            $("#promo_message").html('Промо-код не дійсний, можливо ви зробили помилку');
                            $("#promo_message").show();
                        }


                    }

                });





            }
            else
            {
                discount = 1;
            }
            
            
            
            if (discount == 1)
            {
           var   aaa =  send_request(action);
            }
                


return aaa;


            // если результат положытельный

            // если результат отрецательный     


        }
        
        
        
        
        function send_request(action)
        {
            {
                var discount;
                if (($('#promocode').val() != null) && ($('#promocode').val() != ""))
            {
                discount = 1;
            }
            else
            {
                discount = 2;
            }
            var summ_to_pay = $('#summPay').val();
                    if (action == 'nal')
                    {
                        var way_to_pay = "Готівкою";
                    }
                    if (action == 'nal_z')
                    {
                        var way_to_pay = "Заявка";
                    }
                    if (action == 'card')
                    {
                        var way_to_pay = "Оплата на карту";
                    }

                    if ($('#prepay').is(':checked') == true)
                    {
                        var prepay = 1;
                    } else
                    {
                        var prepay = 2;
                    }



                    var lessons_to_visit = '';

                    var lessons = $('input:checkbox:checked').map(function () {
                        return this.value;
                    }).get();

                    //lessons = $('.lessons:checkbox:checked');

                    for (i = 0; i < lessons.length; i++)
                    {
                        lessons_to_visit += lessons[i] + ' ';
                    }
                        var is_send = 0;
                    $.ajax({
                        method: 'POST',
                        url: "/update",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {PIB: $('#name').val(),
                            //company_name:$('#company').val(),
                            phone_number: $('#phone').val(),
                            E_mail: $('#email').val(),
                            training_id: $('#training_id').val(),
                            //wishes:$('#wishes').val(),
                            present: $('input[name=present]:checked', '#form').val(),
                            //sphere:$('#scope').val(),
                            lessons_to_visit: lessons_to_visit,
                            promo: $('#promocode').val(),
                            discount: discount,
                            way_to_pay: way_to_pay,
                            summ_to_pay: summ_to_pay,
                            prepay: prepay,
                            action:action

                        },
                        async: false,
                        beforeSend: function (xhr) {
                            //            var token = $('meta[name="csrf_token"]').attr('content');
                            //        if (token) {
                            //                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
                        },
                        success: function (data) {
                        is_send = data;
                            console.log(data.error);
                            console.log(data.message);
                            console.log(data.discount);


                            var sum_all = 0;
                            if ($("#full_price").is(':checked'))
                            {
                                sum_all = $('#price_val').val();
                            } else
                            {
                                $('.lessons').each(function ()
                                {
                                    if ($(this).is(':checked'))
                                    {
                                        $("#full_price").prop('checked', false);
                                        sum_all = sum_all + parseInt($(this).attr('data-price'));
                                    }
                                })
                            }


                            var sum = Math.round(sum_all - ((sum_all / 100) * data.discount));
                            $('#persent').html(sum / 100);
                            if ($('#prepay').is(':checked') == true)
                            {

                                var ss = $('#persent').html();
                                sum = ss * 30;
                            } else
                            {
                                var ss = $('#persent').html();
                                sum = ss * 100;
                            }
                            //  $("#paypaypay").html(sum);
                            $("#paypaypay").html(sum);

                            //  $('#openModal').click();
                                    

                        },
                        error: function (data) {
                            is_send = 0;
                            var errors = data.responseJSON;
                            console.log(errors);
                            
                        }


                    });
                    if(is_send)
                    {
                        return is_send;
                    }
                    else
                    {
                    return false;
                    }
                }
        }



        $(function ()
        {
            $('.bsend').click(function ()
            {
                var action = $(this).data('action');
                var r = pay(action); 
                if (r)
                {
                    if ((action == 'nal')||(action == 'nal_z'))
                    {
                        // показать модальное окно с благодарностью
                        $('#openModal').click();
                    }
                    if (action == 'card')
                    {
                        // перейти на страницу оплаты
                        if (r.send_link!=undefined)
                        {
                          window.location=r.send_link;
                        }
                    }

                }


            });

            $('.les').click(function ()
            {
                var les_count = $('.lessons').length;
                if ($(this).hasClass('lessons'))
                {
                    $("#full_price").prop('checked', false);
                }
                var p = 0;
                if ($("#full_price").is(':checked')) {
                    p = $('#price_val').val();
                    $('.lessons').prop('checked', false);
                } else
                {

                    var c = 0;
                    $('.lessons').each(function ()
                    {
                        if ($(this).is(':checked'))
                        {
                            $("#full_price").prop('checked', false);
                            p = p + parseInt($(this).attr('data-price'));
                            c = c+1;
                        }
                        if (c == les_count)
                        {
                          $('.lessons').prop('checked', false);
                          $("#full_price").prop('checked', true);
                          p = $('#price_val').val();
                        }
                    })
                }
                $('#persent').html(p / 100);
                var ss = $('#persent').html();

                if ($('#prepay').is(':checked') == true)
                {

                    $('#paypaypay').html(ss * 30);
                    $('#summPay').val(ss * 30);
                } else
                {
                    $('#paypaypay').html(ss * 100);
                    $('#summPay').val(ss * 100);
                }

            });

        });



        $("#checkCode").click(function (e)
        {
            e.preventDefault(e);
            var url = $('#urrL').val();

            var sum_all = 0;
            if ($("#full_price").is(':checked'))
            {
                sum_all = $('#price_val').val();
            } else
            {
                $('.lessons').each(function ()
                {
                    if ($(this).is(':checked'))
                    {
                        $("#full_price").prop('checked', false);
                        sum_all = sum_all + parseInt($(this).attr('data-price'));
                    }
                })
            }

            //  alert($('#promocode').val());
            // alert($('#training_id').val());

            $.ajax({
                method: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    promo_code: $('#promocode').val(),
                    id: $('#training_id').val()

                },
                beforeSend: function (xhr) {
                    //            var token = $('meta[name="csrf_token"]').attr('content');
                    //        if (token) {
                    //                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
                },
                success: function (data) {
                    if (data.error == 'no')
                    {
                        console.log(data.error);
                        console.log(data.message);
                        console.log(data.discount);

                        $("#promo_message").css("color", "green");
                        $("#promo_message").html(data.message);



                        var sum = Math.round(sum_all - ((sum_all / 100) * data.discount));
                        // console.log(sum);
                        $('#persent').html(sum / 100);
                        if ($('#prepay').is(':checked') == true)
                        {

                            var ss = $('#persent').html();
                            sum = ss * 30;
                        } else
                        {
                            var ss = $('#persent').html();
                            sum = ss * 100;
                        }
                        $("#paypaypay").html(sum);

                    } else
                    {

                        console.log('error');
                        console.log('message');
                        console.log(data.id);
                        console.log(data.promo);
                        $("#paypaypay").html(sum_all);

                        $("#promo_message").css("color", "red");
                        $("#promo_message").html('Промо-код не дійсний, можливо ви зробили помилку');
                        $("#promo_message").show();
                    }
                },
                error: function (data) {
                    alert('error');
                }
            });
        });


                $('#close_dialog').click(function ()
                {
                    location.reload();
                });





        jQuery(function ($) {
 

            $("#prepay").change(function () {

                //$("#persent").html($('#paypaypay').html()/100);


                if (this.checked) {

                    var b = Math.round($('#persent').html() * 30);

                    $('#paypaypay').html(b);
                    $('#summPay').val(b);
                } else
                {

                    b = Math.round($('#persent').html() * 100);

                    $('#paypaypay').html(b);
                    $('#summPay').val(b);
                }
            });


        });

        </script>
    </body>
</html>