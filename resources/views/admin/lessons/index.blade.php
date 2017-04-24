@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Уроки</div>
                  
					<div class="panel-body">
                      <a href="/admin/lessons/create" class="btn btn-default" style="margin-bottom: 15px"  >Добавить урок</a>
                      
                      <table class="table table-bordered dataTables_wrapper form-inline dt-bootstrap" id="lesson-table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Тренинг</th>
                            <th>Название</th>
                            <th>Изображение</th>
                            <th>Статус</th>
                            <th>Действие</th>
                          </tr>
                        </thead>
                      </table>
<!--                       { data: 'id', name: 'id' },
            { data: 'description', name: 'description' },
            { data: 'begin_date', name: 'begin_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'image', name: 'image' },
            { data: 'lektor_id', name: 'lektor_id' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}-->
                      
                      
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('ls')
<script>
$(function() {
    $('#lesson-table').DataTable({
        processing: true,
        serverSide: true,
        language : rus_lang,
        ajax: '{!! url('admin/lessons/users_data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'training_id', name: 'training_id' },
            { data: 'name', name: 'name' },
            { data: 'image', name: 'image' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    $('#lesson-table').on('click','.block',function()
    {
       var id = $(this).data('id');
       $.post('/admin/lessons/change_status',{'lesson_id':id},function(res)
       {
          var r = jQuery.parseJSON(res);
          if (r.res == 'ok')
          {
             $('#s'+id).replaceWith(r.status);
             $('#b'+id).replaceWith(r.block_button);
          }
          else
          {
            alert(r.message);
          }
       });
       
       
    });
    
    
    
    
});
</script>
@endpush


