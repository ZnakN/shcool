@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Пользователи</div>

					<div class="panel-body">
                      <table class="table table-bordered dataTables_wrapper form-inline dt-bootstrap" id="users-table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Дата создания</th>
                            <th>Роль</th>
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
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        language : rus_lang,
        ajax: '{!! url('admin/users/users_data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'role', name: 'role' },
            { data: 'status', name: 'status' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    $('#users-table').on('click','.block',function()
    {
       var id = $(this).data('id');
       $.post('/admin/users/change_status',{'user_id':id},function(res)
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


