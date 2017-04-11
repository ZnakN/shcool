@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Бренды</div>
                  
					<div class="panel-body">
                      <a href="/admin/brands/create" class="btn btn-default" style="margin-bottom: 15px"  >Добавить бренд</a>
                      
                      <table class="table table-bordered dataTables_wrapper form-inline dt-bootstrap" id="brands-table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Название</th>
                            <th>Логотип</th>
                            <th>Дата создания</th>
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
        ajax: '{!! url('admin/brands/users_data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name_ru', name: 'name_ru' },
            { data: 'logo',name:'logo'},
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    $('#brands-table').on('click','.block',function()
    {
       var id = $(this).data('id');
       $.post('/admin/brands/change_status',{'brand_id':id},function(res)
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


