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
                          <label for="name">Промокод</label>
                          <input type="input" class="form-control" value=""  id="url" placeholder="Промокод" name="code" >
                        </div>
                        
                        
                        <div class="form-group">
                          <label for="name">% Скидка</label>
                          <input type="input" class="form-control" value=""  id="url" placeholder="% Скидки" name="value" >
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Количество действий промокодов</label>
                          <input type="input" class="form-control" value="10"  id="name_ru" placeholder="Количество действий промокодов" name="count" >
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



