@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Заявки</div>
                  
                  
                  
                  <div> 
                      <select name="train" id="train" class="custom-select">
                    <option value="Все">Все</option>
                           @foreach($trainings as $training)
                           @if($training->is_static!=1)
                           <option value="{{$training->id}}">{{$training->name.' ('.date('d.m.Y',strtotime($training->begin_date)).' '.date('d.m.Y',strtotime($training->end_date)).')'}}</option>
                           @else
                           <option value="{{$training->id}}">{{$training->name}}</option>
                           @endif;
                           @endforeach
                </select>          
                  </div>
                  
					<div class="panel-body">
<!--                      <a href="/admin/trainings/create" class="btn btn-default" style="margin-bottom: 15px"  >Добавить тренинг</a>-->
                      
                      <table class="table table-bordered dataTables_wrapper form-inline dt-bootstrap" id="brands-table">
                        <thead>
                          <tr>
                            <th>Id</th><!--
-->                            <th>Имя фамилия отчество</th><!--
                            <th>Название компании</th>
                            <th>Телефон</th>
                            <th>E-mail</th>
-->                            <th>Название тренинга</th><!--
                            <th>Пожелания</th>
                            <th>Подарок</th>
                            <th>Сфера деятельности</th>
                            <th>Сколько уроков</th>
-->                            <th>Оплачено</th><!--
                            <th>Скидка</th>
-->                            <th>Статус</th>
                                <th>Время</th>
                            <th>Действие</th>
                          </tr>
                        </thead>
                      </table>
 <a href="/admin/requests/export" class="btn btn-default" style="margin-bottom: 15px"  >Экпорт</a>
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
         searching: true,
            info: true,
            lengthChange: true,
            retrieve: true,
        language : rus_lang,
        ajax: '{!! url('admin/requests/users_data') !!}',
        order: [[ 0, "desc" ]],
        columns: [
         { data: 'id', name: 'id' },
            { data: 'PIB', name: 'PIB' },
//            { data: 'company_name', name: 'company_name' },
//            { data: 'phone_number', name: 'phone_number' },
//            { data: 'E_mail', name: 'E_mail' },
            { data: 'training_id', name: 'training_id' },
//            { data: 'wishes', name: 'wishes' },
//            { data: 'present', name: 'present' },
//            { data: 'lessons_to_visit', name: 'lessons_to_visit' },
//            { data: 'sphere', name: 'sphere' },
            { data: 'payed', name: 'payed' },
//            { data: 'discount', name: 'discount' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
         "columnDefs": [
    { className: "my_class", "targets": [ 2 ] }
  ]
    });
    
    $('#brands-table').on('click','.block',function()
    {
       var id = $(this).data('id');
       $.post('/admin/requests/change_status',{'requests_id':id},function(res)
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
    
        $('#brands-table').on('click','.delete',function()
    {
       var id = $(this).data('id');
      
       $.post('/admin/requests/delete',{'requests_id':id},function(res)
       {
          var r = jQuery.parseJSON(res);
          if (r.res == 'ok')
          {
             $('#d'+id).closest('tr').remove();
            
          }
          else
          {
            alert(r.message);
          }
       });
       
       
    });
    
    
    $('select[name="train"]').on("change", function(event){
    var train = $('select[name="train"]').val();
    console.log(train);
    var table = $('#brands-table').DataTable();
    if(train == 'Все')
    {
 table.columns('.my_class')
        .search('')
        .draw();
    }
    else
    {
    table.columns('.my_class')
        .search(train)
        .draw();
    }
//<span>Тренинг222</span>
});
    
    
    

});
</script>
<!--<script>
$(function() {
    $('#brands-table').DataTable({
        processing: true,
        serverSide: true,
        language : rus_lang,
        ajax: '{!! url('admin/requests/users_data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'begin_date', name: 'begin_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'image', name: 'image' },
            { data: 'lektor_id', name: 'lektor_id' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    $('#brands-table').on('click','.block',function()
    {
       var id = $(this).data('id');
       $.post('/admin/trainings/change_status',{'trainings_id':id},function(res)
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
</script>-->
@endpush


