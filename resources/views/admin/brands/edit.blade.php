@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-7 col-md-offset-1">
				<div class="panel panel-default">
                  <div class="panel-heading">{{ trans('admin.brands.brands') }}</div>

					<div class="panel-body">
                      <form action="/admin/brands/update" method="post" role="form" enctype="multipart/form-data" >
                        <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if ($brand->id)
                        <input type="hidden" name="id" value="{{$brand->id}}">
                        
                        <div class="form-group">
                          <label for="id">Id</label>
                          <input type="input" class="form-control" value="{{$brand->id}}"  id="id" placeholder="id" name="Id" readonly="true" >
                        </div>
                        @endif
                        
                        
                        <div class="form-group">
                          <label for="name">Url</label>
                          <input type="input" class="form-control" value="{{$brand->url}}"  id="url" placeholder="Url" name="url" >
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Название</label>
                          <input type="input" class="form-control" value="{{$brand->name_ru}}"  id="name_ru" placeholder="Name Ru" name="name_ru" >
                        </div>
                        
                        <!--div class="form-group">
                          <label for="name">Name Ua</label>
                          <input type="input" class="form-control" value="{{$brand->name_ua}}"  id="name_ua" placeholder="Name Ua" name="name_ua" >
                        </div-->
                        
                        <div class="form-group">
                          <label for="text_ru">Текс</label>
                          <textarea class="form-control"   id="text_ru" placeholder="Text Ru" name="text_ru" >{{$brand->text_ru}}</textarea>
                        </div>
                        
                        <!--div class="form-group">
                          <label for="text_ua">Text Ua</label>
                          <textarea class="form-control"   id="text_ua" placeholder="Text Ua" name="text_ua" >{{$brand->text_ua}}</textarea>
                        </div-->
                        
<!--                        <div class="form-group">
                          <label for="role">Logo image</label>
                          <?php Img::show('logo',$brand->logo,'brands','500x200',['main'=>'600x500','tumb'=>'125x100']); ?>
                        </div>-->
                        
                        <div class="input-group">
                          <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> Изображение
                            </a>
                          </span>
                          <input id="thumbnail" class="form-control" type="text" @if ($brand->logo) value="{{$brand->logo}}" @endif   name="logo">
                        </div>
                        <img id="holder" @if ($brand->logo) src="{{$brand->logo}}" @endif   style="margin-top:15px;max-height:100px;">
                             
                        <div class="form-group">
                          <label for="name">Мета Title</label>
                          <input type="input" class="form-control" value="{{$brand->meta_title_ru}}"  id="meta_title_ru" placeholder="Meta title" name="meta_title_ru" >
                        </div>
                             
                        <div class="form-group">
                          <label for="name">Мета Description</label>
                          <textarea class="form-control" id="meta_description_ru"  name="meta_description_ru" >{{$brand->meta_description_ru}} </textarea>
                        </div>     
                             
                        <div class="form-group">
                          <label for="name">Мета Key Words</label>
                          <input type="input" class="form-control" value="{{$brand->meta_keywords_ru}}"  id="meta_keywords_ru" placeholder="Meta KeyWords" name="meta_keywords_ru" >
                        </div>     
                             
                             
                             
                        <div class="form-group">
                          <label for="role">Статус</label>
                          <select class="form-control" name="status" id="status" >
                            <option value="1" @if ($brand->status == 1) {!! 'selected="selected"' !!} @endif >Активный</option>
                            <option value="2" @if ($brand->status != 1) {!! 'selected="selected"' !!} @endif >Заблокирован</option>
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
    CKEDITOR.replace( 'text_ru',options );
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
      outputUrlId:'logo',
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
      $('#load_image').html('<img src="'+data.url+'" width="'+div_img.width()+'" height="'+div_img.height()+'"   alt="logo">');
      },
      };
    
    
    var cropperHeader = new Croppic('img_d',options);
    
    $('#lfm').filemanager('image');

});  

</script>
@endpush


