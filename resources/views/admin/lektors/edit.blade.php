@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-7 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">Лекторы</div>

					<div class="panel-body">
                      <form action="/admin/lektors/update" method="post" role="form" enctype="multipart/form-data" >
                        <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if ($lektors->id)
                        <input type="hidden" name="id" value="{{$lektors->id}}">
                        
                        <div class="form-group">
                          <label for="id">Id</label>
                          <input type="input" class="form-control" value="{{$lektors->id}}"  id="id" placeholder="id" name="Id" readonly="true" >
                        </div>
                        @endif
                        
                        
                      
                        
                        <div class="form-group">
                          <label for="name">Имя фамилия</label>
                          <input type="input" class="form-control" value="{{$lektors->name_surname}}"  id="name_surname" placeholder="name_surname" name="name_surname" >
                        </div>
                        
                     
                        
                        <div class="form-group">
                          <label for="text_ru">Описание</label>
                          <textarea class="form-control"   id="description" placeholder="description" name="description" >{{$lektors->description}}</textarea>
                        </div>
                        
                        <div class="form-group">
                          <label for="name">URL</label>
                          <input type="input" class="form-control" value="{{$lektors->url}}"  id="url" placeholder="url" name="url" >
                        </div>
                        
<!--                        <div class="form-group">
                          <label for="role">Logo image</label>
                          <?php Img::show('lektors',$lektors->image,'brands','500x200',['main'=>'600x500','tumb'=>'125x100']); ?>
                        </div>-->
                        
                        <div class="input-group">
                          <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> Изображение
                            </a>
                          </span>
                          <input id="thumbnail" class="form-control" type="text" @if ($lektors->image) value="{{$lektors->image}}" @endif   name="image">
                        </div>
                        <img id="holder" @if ($lektors->image) src="{{$lektors->image}}" @endif   style="margin-top:15px;max-height:100px;">
                             
                        <div class="form-group">
                          <label for="name">Мета Title</label>
                          <input type="input" class="form-control" value="{{$lektors->meta_title}}"  id="meta_title" placeholder="Meta title" name="meta_title" >
                        </div>
                             
                        <div class="form-group">
                          <label for="name">Мета Description</label>
                          <textarea class="form-control" id="meta_description"  name="meta_description" placeholder="Meta description">{{$lektors->meta_description}} </textarea>
                        </div>     
                             
                        <div class="form-group">
                          <label for="name">Мета Key Words</label>
                          <input type="input" class="form-control" value="{{$lektors->meta_keywords}}"  id="meta_keywords" placeholder="Meta KeyWords" name="meta_keywords" >
                        </div>     
<!--                             a
                             -->
                             
                        <div class="form-group">
                          <label for="role">Статус</label>
                          <select class="form-control" name="status" id="status" >
                            <option value="1" @if ($lektors->status == 1) {!! 'selected="selected"' !!} @endif >Активный</option>
                            <option value="2" @if ($lektors->status != 1) {!! 'selected="selected"' !!} @endif >Заблокирован</option>
                          </select>
                        </div>
                        
                        <div class="form-group">
                          
                          <input type="submit" class="btn btn-info" value="Обновить" >
                          <a href="/admin/brands" class="btn btn-danger"  >Отмена</a>
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


