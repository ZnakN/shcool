@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Промо коды</div>
                  
					<div class="panel-body">
                      <a href="/admin/discounts/add" class="btn btn-default" style="margin-bottom: 15px"  >Создать промо код</a>
                      
                      <table class="table table-bordered dataTables_wrapper form-inline dt-bootstrap" id="discounts-table">
                        <thead>
                          <tr>
                            <th>Id</th>

                            <th>Промо - код</th>
                            <th>Значение скидки %</th>
                            <th>Использована</th>
                            <th>Удалить скидку</th>
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
    $('#discounts-table').DataTable({
        processing: true,
        serverSide: true,
        language : rus_lang,
        ajax: '{!! url('admin/discounts/users_data') !!}',
        rowId: 'someId',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'code', name: 'code' },
            { data: 'value', name: 'value' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    
     $('#discounts-table').on('click','.delete',function()
    {
         
       
      
       // alert(id);
         var id = $(this).attr('data-id');
       $.post('/admin/discounts/delete',{'discount_id':id},function(res)
       {
          var r = jQuery.parseJSON(res);
          if (r.res == 'ok')
          {
               
              $('#b'+id).closest("tr").remove();
             // $('#b'+id).remove();  .remove();
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


