@extends('layouts.admin')

@section('main-content')
<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
<!--                  <div class="panel-heading">{{ trans('admin.trainings.trainings') }}</div>-->
            <div class="panel-heading">Trainings</div>

					<div class="panel-body">
<!--                                             action="/admin/trainings/update" method="post" role="form" enctype="multipart/form-data"-->
                      <form enctype="multipart/form-data" id="forma">
                        <div class="box-body">
                       
                        @if ($trainings->id)
<!--                        <input type="hidden" name="id" value="{{$trainings->id}}">-->
                        
                        <div class="form-group">
                          <label for="id">Id</label>
                          <input type="input" class="form-control" value="{{$trainings->id}}"  id="id" placeholder="id" name="Id" readonly="true" >
                        </div>
                        @endif
                        

                        <div class="form-group">
                          <label for="name">Название</label>
                          <input type="input" class="form-control" value="{{$trainings->name}}"  id="name" placeholder="name" name="name"  >
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Заголовок на странице тренинга</label>
                          <input type="input" class="form-control" value="{{$trainings->internal_title}}"  id="zag" placeholder="Заголовок на странице тренинга" name="internal_title"  >
                        </div>

                        <div class="form-group">
                          <label for="type">Тип тренинга</label>
                          <input type="input" class="form-control" value="{{$trainings->type}}"  id="type" placeholder="type" name="type"  >
                        </div>
                        
                        <div class="form-group">
                          <label for="text_ru">Описание</label>
                          <textarea class="form-control"   id="description" placeholder="description" name="description" >{{$trainings->description}}</textarea>
                        </div>
<!--                         <textarea class="form-control"   id="description2" placeholder="description" name="description2" >{{$trainings->description}}</textarea>-->
                        <div class="form-group">
                          <label for="name">URL</label>
                          <input type="input" class="form-control" value="{{$trainings->url}}"  id="url" placeholder="url" name="url" >
                        </div>
                        
                        
<!--            size="3"            Лектор ----------------------------------------------------->
                         <div class="form-group">
                          <label for="name">Лектор</label>
                          <select class="form-control" name="lektor_id" id="lektor" size="5" >    
                               @foreach ($lektors as $lektor)
                            <option value="{{$lektor->id}}"  @if ($trainings->lektor_id == $lektor->id) {!! 'selected="selected"' !!} @endif >{{$lektor->name_surname}}</option>
                            @endforeach
                          </select>
                        </div>
<!--                        end Лектор-------------------------------------------------->
                        
                         <div class="form-group">
                          <label for="name">Дата начала</label>
                          <input type="date" class="form-control" value="{{$trainings->begin_date}}"  id="begin_date"  name="begin_date" >
                        </div>
                             
                        <div class="form-group">
                          <label for="name">Дата окончания</label>
                          <input type="date" class="form-control" value="{{$trainings->end_date}}"  id="end_date"  name="end_date" >
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Время начала</label>
                          <input type="time" class="form-control" value="{{$trainings->time_from}}"  id="time_from"  name="time_from" >
                        </div>

                        <div class="form-group">
                          <label for="name">Время окончания</label>
                          <input type="time" class="form-control" value="{{$trainings->time_to}}"  id="time_to"  name="time_to" >
                        </div>


                        <div class="form-group">
                          <label for="name">Место проведения</label>
                          <input type="input" class="form-control" value="{{$trainings->adress_where}}"  id="adress_where"  name="adress_where" >
                        </div>

                        <div class="form-group">
                          <label for="name">Адрес</label>
                          <input type="input" class="form-control" value="{{$trainings->adress}}"  id="adress"  name="adress" >
                        </div>

                        <div class="form-group">
                          <label for="name">Общая цена</label>
                          <input type="number" min="1" step="any" class="form-control" value="{{$trainings->full_price}}"  id="full_price"  name="full_price" >
                        </div>

                        

                  
                        
<!--                        <div class="form-group">
                          <label for="role">Logo image</label>
                          <?php Img::show('image',$trainings->image,'brands','500x200',['main'=>'600x500','tumb'=>'125x100']); ?>
                        </div>-->
                        
                        <div class="input-group">
                          <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> Изображение
                            </a>
                          </span>
                          <input id="thumbnail" class="form-control" type="text" @if ($trainings->image) value="{{$trainings->image}}" @endif   name="image">
                        </div>
                        <img id="holder" @if ($trainings->image) src="{{$trainings->image}}" @endif   style="margin-top:15px;max-height:100px;">
                             
                       
                         <div class="form-group">
                           <label for="meta_title">Мета Title</label>

                          <input type="input" class="form-control" value="{{$trainings->meta_title}}"  id="meta_title" placeholder="Meta title" name="meta_title" >
                        </div>
                             
                        <div class="form-group">
                          <label for="meta_description">Мета Description</label>
                          <textarea class="form-control" id="meta_description" placeholder="Meta description"  name="meta_description" >{{$trainings->meta_description}} </textarea>
                        </div>     
                             
                        <div class="form-group">
                          <label for="meta_keywords">Мета Key Words</label>
                          <input type="input" class="form-control" value="{{$trainings->meta_keywords}}"  id="meta_keywords" placeholder="Meta KeyWords" name="meta_keywords" >
                        </div>          
                             
                             
                             
                        <div class="form-group">
                          <label for="role">Статус</label>
                          <select class="form-control" name="status" id="status" >
                            <option value="1" @if ($trainings->status == 1) {!! 'selected="selected"' !!} @endif >Активный</option>
                            <option value="2" @if ($trainings->status != 1) {!! 'selected="selected"' !!} @endif >Заблокирован</option>
                          </select>
                        </div>
                             
                              <div class="form-group">
                          <label for="role">Статический тренинг</label>
                          <select class="form-control" name="is_static" id="is_static" >
                            <option value="1" @if ($trainings->is_static == 1) {!! 'selected="selected"' !!} @endif >Да</option>
                            <option value="2" @if ($trainings->is_static != 1) {!! 'selected="selected"' !!} @endif >Нет</option>
                          </select>
                        </div>
                             
                             
                        
                        <div class="form-group">
                          
                          <input type="submit" class="btn btn-info" value="Обновить" >
                          <a href="/admin/trainings" class="btn btn-danger"  >Отмена</a>
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
      var div = $('#img_d');
      var div_img = $('#load_image');
      var options = {
      uploadUrl: '/admin/images/upload',
      cropUrl: '/admin/images/crop',
      modal:true,
      outputUrlId:'image',
      customUploadButtonId:'load_logo',
      uploadData:{
        '_token':'{{csrf_token()}}'
      },
      cropData:{
        'width' : div.width(),
        'height': div.height(),
        '_token':'{{csrf_token()}}'
      },
      onReset:		function(){ console.log('onReset') },
      onAfterImgCrop:		function(data){
      $('#img_d').hide();
      $('#load_image').html('<img src="'+data.url+'" width="'+div_img.width()+'" height="'+div_img.height()+'"   alt="image">');
      },
      };
    
    
    var cropperHeader = new Croppic('img_d',options);
    
    $('#lfm').filemanager('image');

});  

 $("#forma").submit(function(e)
    {

        e.preventDefault(e);
        
       // alert(CKEDITOR.instances['description'].getData());
         $.ajax({
                            method: 'POST',
                            url:'/admin/trainings/update',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
            'id':$('#id').val(),
            'name':$('#name').val(),
            'internal_title':$('#zag').val(),
            'type':$('#type').val(),
            'description':CKEDITOR.instances['description'].getData(),
            'url':$('#url').val(),
            'lektor_id':$('#lektor option:selected').val(),
            'begin_date':$('#begin_date').val(),
            'end_date':$('#end_date').val(),
            'time_from':$('#time_from').val(),
            'time_to':$('#time_to').val(),
               'adress_where':$('#adress_where').val(),
               'adress':$('#adress').val(),
               'full_price':$('#full_price').val(),
              'image':$('#thumbnail').val(),
              'meta_title':$('#meta_title').val(),
               'meta_description':$('#meta_description').val(),
               'meta_keywords':$('#meta_keywords').val(),
           'status':$('#status option:selected').val(),
            'is_static':$('#is_static option:selected').val(),
                            },
                            beforeSend: function (xhr) {
                                //            var token = $('meta[name="csrf_token"]').attr('content');
                                //        if (token) {
                                //                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
                                $('#name').css("border-color", "#ccc"); 
                                $('#zag').css("border-color", "#ccc");
                                $('#type').css("border-color", "#ccc");
                                $('#description').css("border-color", "#ccc");
                                $('#lektor').css("border-color", "#ccc");
                                $('#begin_date').css("border-color", "#ccc");
                                $('#end_date').css("border-color", "#ccc");
                                $('#cke_description').css("border-color", "#ccc");
                                $('#time_from').css("border-color", "#ccc");
                                $('#time_to').css("border-color", "#ccc");
                                $('#adress_where').css("border-color", "#ccc");
                                $('#adress').css("border-color", "#ccc");
                                $('#full_price').css("border-color", "#ccc");
                                $('#thumbnail').css("border-color", "#ccc");
                                $('#status').css("border-color", "#ccc");
                                $('#is_static').css("border-color", "#ccc");
                            },
                            success: function (data) {
                                if(data.res == 'no_static')
                                {
                                    if  (CKEDITOR.instances['description'].getData()=='') { $('#cke_description').css("border-color", "red"); }
                                    if  ($('#name').val()=='') { $('#name').css("border-color", "red"); }
                                    if  ($('#zag').val()=='') { $('#zag').css("border-color", "red"); }
                                }
                                else
                               if(data.res == 'no')
                               {
                                  if  ($('#name').val()=='') { $('#name').css("border-color", "red"); }
                                  if  ($('#zag').val()=='') { $('#zag').css("border-color", "red"); }
                                  if  ($('#type').val()=='') { $('#type').css("border-color", "red"); }
                                   if  (CKEDITOR.instances['description'].getData()=='') { $('#cke_description').css("border-color", "red"); }
                                  if  ($('#lektor option:selected').val()=='') { $('#lektor').css("border-color", "red"); }
                                  if  ($('#begin_date').val()=='') { $('#begin_date').css("border-color", "red"); }
                                  if  ($('#end_date').val()=='') { $('#end_date').css("border-color", "red"); }
                                  if  ($('#time_from').val()=='') { $('#time_from').css("border-color", "red"); }
                                  if  ($('#time_to').val()=='') { $('#time_to').css("border-color", "red"); }
                                  if  ($('#adress_where').val()=='') { $('#adress_where').css("border-color", "red"); }
                                  if  ($('#adress').val()=='') { $('#adress').css("border-color", "red"); }
                                  if  ($('#full_price').val()=='') { $('#full_price').css("border-color", "red"); }
                                  if  ($('#thumbnail').val()=='') { $('#thumbnail').css("border-color", "red"); }
                                  
                                  
//                                  if  ($('#meta_title').val()=='') { $('#meta_title').css("border-color", "red"); }
//                                  if  ($('#meta_description').val()=='') { $('#meta_description').css("border-color", "red"); }
                                  if  ($('#status option:selected').val()=='') { $('#status').css("border-color", "red"); }
                                  if  ($('#is_static option:selected').val()=='') { $('#is_static').css("border-color", "red"); }
                                  
                               }
                               else
                               {
                                window.location.href = "/admin/trainings";
                               }
                               
                              

                            },
                            error: function (data) {                              
                               alert('error!');      
                            }


                        });

        
    });

</script>
@endpush


