@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-5 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Редактирование пользователя</div>

					<div class="panel-body">
                      <form action="/admin/users/update" method="post" role="form" >
                        <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$user->id}}">

                        <div class="form-group">
                          <label for="id">Id</label>
                          <input type="input" class="form-control" value="{{$user->id}}"  id="id" placeholder="id" name="Id" readonly="true" >
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Логин/Название </label>
                          <input type="input" class="form-control" value="{{$user->name}}"  id="name" placeholder="Name" name="name" >
                        </div>
                        
                        <div class="form-group">
                          <label for="email">E-mail</label>
                          <input type="input" class="form-control" value="{{$user->email}}"  id="email" placeholder="Email" name="email" readonly="true" >
                        </div>
                        
                        <div class="form-group">
                          <label for="role">Роль</label>
                          <input type="input" class="form-control" value="{{$user->role}}"  id="role" placeholder="Role" name="role" >
                        </div>
                        
                        <div class="form-group">
                          <label for="role">Статус</label>
                          <select class="form-control" name="status" id="status" >
                            <option value="1" @if ($user->status == 1) {!! 'selected="selected"' !!} @endif >Активный</option>
                            <option value="2" @if ($user->status != 1) {!! 'selected="selected"' !!} @endif >Заблокирован</option>
                          </select>
                        </div>
                        
                        <div class="form-group">
                          
                          <input type="submit" class="btn btn-info" value="Обновить" >
                          <a href="/admin/users" class="btn btn-danger"  >Отмена</a>
                        </div>
                        </div>
                      </form>
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
});
</script>
@endpush


