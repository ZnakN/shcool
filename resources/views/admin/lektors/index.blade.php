@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Лекторы</div>
                  
					<div class="panel-body">
                      <a href="/admin/lektors/create" class="btn btn-default" style="margin-bottom: 15px"  >Добавить лектора</a>
                      
                      <table class="table table-bordered dataTables_wrapper form-inline dt-bootstrap" id="brands-table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Имя_Фамилия</th>
                            <th>Описание</th>
                            <th>Изображение</th> 
                            <th>Дата добавления</th>
                            <th>Статус</th>
                            <th>Действие</th>
                          </tr>
                        </thead>
                      </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('ls')
<script>
$(function() {
     $('#brands-table').DataTable({
        processing: true,
        serverSide: true,
        language : rus_lang,
        ajax: '{!! url('admin/lektors/users_data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name_surname', name: 'name_surname' },
            { data: 'description',name:'description'},
            { data: 'image', name: 'image' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    $('#brands-table').on('click','.block',function()
    {
       var id = $(this).data('id');
       $.post('/admin/lektors/change_status',{'lektor_id':id},function(res)
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


