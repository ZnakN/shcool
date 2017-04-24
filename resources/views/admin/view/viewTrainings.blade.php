@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                 
                  
					<div class="panel-body">
                     
                      
                      <table class="table table-bordered dataTables_wrapper form-inline dt-bootstrap" id="brands-table">
                        <thead>
                          <tr>
                           
                            <th>Название тренинга</th>
                            <th>Статус</th>
                            <th>Детали</th>
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
    $('#brands-table').DataTable({
        processing: true,
        serverSide: true,
        language : rus_lang,
       ajax: '{!! url('/admin/viewTrainings/users_data') !!}',
        columns: [
//            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
//            { data: 'begin_date', name: 'begin_date' },
//            { data: 'end_date', name: 'end_date' },
//            { data: 'image', name: 'image' },
//            { data: 'lektor_id', name: 'lektor_id' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
   
    
    
    
    
});
</script>
@endpush


