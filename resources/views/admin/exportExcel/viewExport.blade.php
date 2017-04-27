@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Экпорт в Excel</div>

		  <div >
                    <p>
                     Записей: {{count($requests)}}
                    </p>
                    <a class="btn btn-primary btn-lg" id='export' href="/admin/requests/makeExport" target="_blank">Экспортировать в Excel</a>
                 </div>
                  <a href="/admin/requests" class="btn btn-default" style="margin-bottom: 15px"  >Назад</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



