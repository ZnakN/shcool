@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-7 col-md-offset-1">
				<div class="panel panel-default">
<!--                  <div class="panel-heading">{{ trans('admin.trainings.trainings') }}</div>-->
            <div class="panel-heading">Trainings</div>

					<div class="panel-body">
                      <form action="/admin/trainings/update" method="post" role="form" enctype="multipart/form-data" >
                        <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if ($trainings->id)
                        <input type="hidden" name="id" value="{{$trainings->id}}">
                        
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
                          <label for="text_ru">Описание</label>
                          <textarea class="form-control"   id="description" placeholder="description" name="description" >{{$trainings->description}}</textarea>
                        </div>
                        
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
                          <label for="name">Дата конца</label>
                          <input type="date" class="form-control" value="{{$trainings->end_date}}"  id="end_date"  name="end_date" >
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
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
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

</script>
@endpush


