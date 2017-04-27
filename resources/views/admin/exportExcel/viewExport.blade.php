@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Экпорт в Excel</div>

                  
                  
		  <div style="padding:5px;">
                    <p>
                     Записей: {{count($requests)}}
                    </p>
                  
                    <form action="/admin/requests/makeExport" method="post" role="form" enctype="multipart/form-data" target="_blank">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <div class="form-group">
                          <label for="name">Экпорт с даты</label>
                          <input type="date" class="form-control" value=""  id="begin_date"  name="begin_date" >
                        </div>
                             
                        <div class="form-group">
                          <label for="name">Экспорт по дату</label>
                          <input type="date" class="form-control" value=""  id="end_date"  name="end_date" >
                        </div>
                        
                         <input type="submit" class="btn btn-default" value="Экспортировать в Excel"> <a href="/admin/requests" class="btn btn-default"  >Назад</a>
                    </form>
                    
                    <!--<a class="btn btn-default" id='export' href="/admin/requests/makeExport" target="_blank">Экспортировать в Excel</a>-->  
                   
                 </div>
                
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



