@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-7 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Добавление скидок</div>

					<div class="panel-body">
                      <form action="/admin/discounts/create" method="post" role="form" enctype="multipart/form-data" >
                        <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                          <label for="name">Трениг</label>
                          <select class="form-control" name="training_id" id="lektor" >    
                            @foreach ($trainings as $training)
                            <option value="{{$training->id}}"   >{{$training->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        
                        
                        <div class="form-group">
                          <label for="name">% Скидка</label>
                          <input type="input" class="form-control" value=""  id="url" placeholder="% Скидки" name="value" >
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Количество сгенерированных промокодов</label>
                          <input type="input" class="form-control" value="10"  id="name_ru" placeholder="Количество сгенерированных промокодов" name="count" >
                        </div>
                        
                                                
                        <div class="form-group">
                          
                          <input type="submit" class="btn btn-info" value="Создать" >
                          <a href="/admin/discounts" class="btn btn-danger"  >Отмена</a>
                        </div>
                        </div>
                      </form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection



