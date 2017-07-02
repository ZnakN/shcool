@extends('layouts.admin')

@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <!--                  <div class="panel-heading">{{ trans('admin.trainings.trainings') }}</div>-->
        <div class="panel-heading">Заявка № {{$requests->id}}</div>

        <div class="panel-body">
          <form action="/admin/requests/update" method="post" role="form" enctype="multipart/form-data" >
            <div class="box-body">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
              <input type="hidden" name="id" value="{{$requests->id}}">


             

              <div class="form-group">
                <label for="name">Имя фамилия отчество</label>
                <input type="input" class="form-control" value="{{$requests->PIB}}"  id="PIB" placeholder="Имя фамилия отчество" name="PIB"  >
              </div>

              <div class="form-group">
                <label for="name">Название компании</label>
                <input type="input" class="form-control" value="{{$requests->company_name}}"  id="company_name" placeholder="Название компании" name="company_name"  >
              </div>

              <div class="form-group">
                <label for="name">Телефон</label>
                <input type="input" class="form-control" value="{{$requests->phone_number}}"  id="phone_number" placeholder="Телефон" name="phone_number"  >
              </div>

              <div class="form-group">
                <label for="name">Название тренинга</label>
                <label class="form-control" >{{$requests->training->name}}</label>
              </div>
              
              <div class="form-group">
                <label for="name">E-mail</label>
                <input type="input" class="form-control" value="{{$requests->E_mail}}"  id="E_mail" placeholder="E-mail" name="E_mail"  >
              </div>

              <div class="form-group">
                <label for="name">Подарок</label>
                <label class="form-control" >@if($requests->present==1)Да @else Нет @endif</label>
              </div>
              
              <div class="form-group">
                <label for="name">Сфера деятельности</label>
                <input type="input" class="form-control" value="{{$requests->sphere}}"  id="sphere" placeholder="Сфера деятельности" name="sphere"  >
              </div>
              @if($training_static!=1)
              <div class="form-group">
                <label for="name">Сколько уроков</label>
                <label class="form-control" >{{$requests->lessons_to_visit}}</label>
              </div>
              @else
              <div class="form-group">
                <label for="name">Какие лекторы</label>
                <label class="form-control" >{{$requests->lessons_to_visit}}</label>
              </div>
              @endif
              
               <div class="form-group">
                <label for="name">Сумма оплаты</label>
                <label class="form-control" >{{$requests->summ_to_pay}}</label>
              </div>
              
              
              
              <div class="form-group">
                <label for="role">Оплачено</label>
                <select class="form-control" name="payed" id="payed" >
                  <option value="1" @if ($requests->payed == 1) {!! 'selected="selected"' !!} @endif >Да</option>
                  <option value="2" @if ($requests->payed != 1) {!! 'selected="selected"' !!} @endif >Нет</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="name">Скидка</label>
                <label class="form-control" >@if($requests->promo!=null) Да @else Нет @endif</label>
              </div>
              
              <div class="form-group">
                <label for="name">Промо-код</label>
                <label class="form-control" >{{$requests->promo}}</label>
              </div>
              
              <div class="form-group">
                <label for="name">Способ оплаты</label>
                <label class="form-control" >{{$requests->way_to_pay}}</label>
              </div>
              
              <div class="form-group">
                <label for="name">Дата заявки</label>
                <label class="form-control" >{{date('d.m.Y H:i:s',strtotime($requests->created_at))}}</label>
              </div>

              <div class="form-group">
                <label for="name">Статус</label>
                <label class="form-control" >@if($requests->status==1) Да @else Нет @endif</label>
              </div>
              
              
              <div class="form-group">
              <label for="meta_description">Коментарий</label>
              <textarea class="form-control" id="meta_description" name="comment" rows="10"  >{{$requests->comment}} </textarea>
              </div>    

              <div class="form-group">

                <input type="submit" class="btn btn-info" value="Обновить" >
                <a href="/admin/requests" class="btn btn-danger"  >Отмена</a>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<style>
  label.form-control {background-color: #d7d8d7}
</style>  