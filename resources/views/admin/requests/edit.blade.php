@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-7 col-md-offset-1">
				<div class="panel panel-default">
<!--                  <div class="panel-heading">{{ trans('admin.trainings.trainings') }}</div>-->
                     <div class="panel-heading">Заявки</div>
              
              <table class="table table-bordered dataTables_wrapper form-inline dt-bootstrap" id="brands-table">
                          <thead>
                          <td>
                          <tr>   <th>Id</th> <td>   {{$requests->id}} </td> </tr>
                          <tr>  <th>Имя фамилия отчество</th>  <td>   {{$requests->PIB}} </td> </tr>
                           <tr>       <th>Название компании</th>     <td>   {{$requests->company_name}} </td>  </tr>
                            <tr>      <th>Телефон</th>               <td>  {{$requests->phone_number}} </td>  </tr>
                            <tr>      <th>Название тренинга</th>      <td>   {{$trainings}} </td>   </tr>
                            <tr>      <th>E-mail</th>                <td>   {{$requests->E_mail}} </td>   </tr>
                            <tr>      <th>Пожелания</th>             <td> {{$requests->wishes}} </td>    </tr>
                            
                         @if($requests->present==1)    <tr>      <th>Подарок</th>               <td>   Да </td>     </tr>
                         @else     <tr>      <th>Подарок</th>               <td>   Нет </td>     </tr> 
                         @endif
                         
                            <tr>       <th>Сфера деятельности</th>   <td>   {{$requests->sphere}} </td>         </tr>
                            <tr>       <th>Сколько уроков</th>       <td>   {{$requests->lessons_to_visit}} </td>   </tr>
                            
                            
                          @if($requests->payed==1)    <tr>      <th>Оплачено</th>             <td>   Да </td>    </tr> 
                          @else    <tr>      <th>Оплачено</th>             <td>   Нет </td>    </tr> 
                          @endif
                          
                          
                          @if($requests->promo!=null)  <tr>        <th>Скидка</th>               <td>   Есть </td>   </tr> 
                          @else  <tr>        <th>Скидка</th>               <td>   Нету </td>   </tr>  
                          @endif
                          
                            <tr>       <th>Промо-код</th>            <td>   {{$requests->promo}} </td>     </tr>
                            <tr>       <th>Способ оплаты</th>        <td>   {{$requests->way_to_pay}} </td>    </tr>
                            
                          @if($requests->status==1)    <tr>      <th>Статус</th>             <td>   Активнен </td>    </tr> 
                          @else  <tr>      <th>Статус</th>             <td>   Неактивен </td>    </tr>
                          @endif
                           
                          </td>        
                        </thead>
                      </table>
                          <a href="/admin/requests" class="btn btn-danger"  >Назад</a>
                        </div>
                        
                  
					</div>
				</div>
			</div>
	

@endsection

@push('ls')
<!--<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>-->
<script>
//  var options = {
//    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
//    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
//    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
//    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
//  };
//    CKEDITOR.replace( 'description',options );
    //CKEDITOR.replace( 'text_ua',options );
</script>
<script>
//$(function() 
//{ 
//      var div = $('#img_d');
//      var div_img = $('#load_image');
//      var options = {
//      uploadUrl: '/admin/images/upload',
//      cropUrl: '/admin/images/crop',
//      modal:true,
//      outputUrlId:'image',
//      customUploadButtonId:'load_logo',
//      uploadData:{
//        '_token':'{{csrf_token()}}'
//      },
//      cropData:{
//        'width' : div.width(),
//        'height': div.height(),
//        '_token':'{{csrf_token()}}'
//      },
//      onReset:		function(){ console.log('onReset') },
//      onAfterImgCrop:		function(data){
//      $('#img_d').hide();
//      $('#load_image').html('<img src="'+data.url+'" width="'+div_img.width()+'" height="'+div_img.height()+'"   alt="image">');
//      },
//      };
//    
//    
//    var cropperHeader = new Croppic('img_d',options);
//    
//    $('#lfm').filemanager('image');
//
//});  

</script>
@endpush


