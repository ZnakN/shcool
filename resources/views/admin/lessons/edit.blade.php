@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
<!--                  <div class="panel-heading">{{ trans('admin.trainings.trainings') }}</div>-->
            <div class="panel-heading">Урок</div>

					<div class="panel-body">
                      <form enctype="multipart/form-data" id="forma" >
                        <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if ($lesson->id)
                        <input type="hidden" name="id" value="{{$lesson->id}}">
                        
                        <div class="form-group">
                          <label for="id">Id</label>
                          <input type="input" class="form-control" value="{{$lesson->id}}"  id="id" placeholder="id" name="Id" readonly="true" >
                        </div>
                        @endif
                        
                        <div class="form-group">
                          <label for="name">Название</label>
                          <input type="input" class="form-control" value="{{$lesson->name}}"  id="name" placeholder="name" name="name"  >
                        </div>

                        
                        <div class="form-group">
                          <label for="text_ru">Описание</label>
                          <textarea class="form-control"   id="description" placeholder="description" name="description" >{{$lesson->description}}</textarea>
                        </div>
                        
                        
                        
<!--            size="3"            Лектор ----------------------------------------------------->
                         <div class="form-group">
                          <label for="name">Трениг</label>
                          <select class="form-control" name="training_id" id="training_id" >    
                            @foreach ($trainings as $training)
                              <option value="{{$training->id}}"  @if ($training->id == $lesson->training_id) {!! 'selected="selected"' !!} @endif >{{$training->name}}</option>
                            @endforeach
                          </select>
                        </div>
<!--                        end Лектор-------------------------------------------------->
                        
                        <div class="form-group">
                          <label for="name">Цена за урок</label>
                          <input type="number" min="1" step="any" class="form-control" value="{{$lesson->price}}"  id="price"  name="price" >
                        </div>             

                        
<!--                      -->
                        
<!--                        <div class="input-group">
                          <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> Изображение
                            </a>
                          </span>
                          <input id="thumbnail" class="form-control" type="text" @if ($lesson->image) value="{{$lesson->image}}" @endif   name="image">
                        </div>
                        <img id="holder" @if ($lesson->image) src="{{$lesson->image}}" @endif   style="margin-top:15px;max-height:100px;">-->
                             
                       
                         <div class="form-group">
                           <label for="meta_title">Мета Title</label>
                          <input type="input" class="form-control" value="{{$lesson->meta_title}}"  id="meta_title" placeholder="Meta title" name="meta_title" >
                        </div>
                             
                        <div class="form-group">
                          <label for="meta_description">Мета Description</label>
                          <textarea class="form-control" id="meta_description" placeholder="Meta description"  name="meta_description" >{{$lesson->meta_description}} </textarea>
                        </div>     
                             
                        <div class="form-group">
                          <label for="meta_keywords">Мета Key Words</label>
                          <input type="input" class="form-control" value="{{$lesson->meta_keywords}}"  id="meta_keywords" placeholder="Meta KeyWords" name="meta_keywords" >
                        </div>          
                             
                             
                             
                        <div class="form-group">
                          <label for="role">Статус</label>
                          <select class="form-control" name="status" id="status" >
                            <option value="1" @if ($lesson->status == 1) {!! 'selected="selected"' !!} @endif >Активный</option>
                            <option value="2" @if ($lesson->status != 1) {!! 'selected="selected"' !!} @endif >Заблокирован</option>
                          </select>
                        </div>
                        
                        <div class="form-group">
                          
                          <input type="submit" class="btn btn-info" value="Обновить" >
                          <a href="/admin/lessons" class="btn btn-danger"  >Отмена</a>
                        </div>
                        </div>
                        <div id="img_d" style="display:none" ></div>
                      </form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('ls')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<!--<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>-->
<script src="https://cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
    CKEDITOR.replace( 'description',options );
    //CKEDITOR.replace( 'text_ua',options );
</script>
<script>
$(function() 
{ 
      
    
    //$('#lfm').filemanager('image');
    
    
    
    
    $("#forma").submit(function(e)
    {

        e.preventDefault(e);
        
       // alert(CKEDITOR.instances['description'].getData());
         $.ajax({
                            method: 'POST',
                            url:'/admin/lessons/update',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
            'id':$('#id').val(),
            'name':$('#name').val(),           
            'description':CKEDITOR.instances['description'].getData(),         
            'training_id':$('#training_id option:selected').val(),
            'price':$('#price').val(),
              'meta_title':$('#meta_title').val(),
               'meta_description':$('#meta_description').val(),
               'meta_keywords':$('#meta_keywords').val(),
           'status':$('#status option:selected').val(),
           
                            },
                            beforeSend: function (xhr) {
                                //            var token = $('meta[name="csrf_token"]').attr('content');
                                //        if (token) {
                                //                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
                                $('#name').css("border-color", "#ccc"); 
                                $('#description').css("border-color", "#ccc");
                                $('#training_id').css("border-color", "#ccc");
                                 $('#price').css("border-color", "#ccc");
                                $('#cke_description').css("border-color", "#ccc");                             
                                $('#status').css("border-color", "#ccc");
                            },
                            success: function (data) {
                              
                               if(data.res == 'no')
                               {
                                  if  ($('#name').val()=='') { $('#name').css("border-color", "red"); }
                                  if  ($('#price').val()=='') { $('#price').css("border-color", "red"); }
                                  if  ($('#training_id option:selected').val()=='') { $('#training_id').css("border-color", "red"); }
                                   if  (CKEDITOR.instances['description'].getData()=='') { $('#cke_description').css("border-color", "red"); }                                   
//                                  if  ($('#meta_title').val()=='') { $('#meta_title').css("border-color", "red"); }
//                                  if  ($('#meta_description').val()=='') { $('#meta_description').css("border-color", "red"); }
                                  if  ($('#status option:selected').val()=='') { $('#status').css("border-color", "red"); }
                                
                                  
                               }
                               else
                               {
                                window.location.href = "/admin/lessons";
                               }
                               
                              

                            },
                            error: function (data) {                              
                               alert('error!');      
                            }


                        });

        
    });

});  

</script>
@endpush


