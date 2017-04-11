/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function()
{
  
  function initCroppic(name)
  {
    var div = $('#img_'+name);
    var div_crop = $('#img_crop_'+name); 
    var token = $('#val_'+name).data('token');
    var sizes = $('#val_' + name).data('sizes');
    var path = $('#val_'+name).data('path');
    var crop_w = div_crop.width();
    var crop_h = div_crop.height();
    
    console.log(name)
    console.log(token);
    console.log(crop_w);
    console.log(crop_h);
    console.log(sizes);
    var options = {
      uploadUrl: '/admin/images/upload',
      cropUrl: '/admin/images/crop',
      modal: true,
      customUploadButtonId: 'b_upload_'+name,
      uploadData: {
        '_token': token
      },
      cropData: {
        'width': crop_w,
        'height': crop_h,
        '_token': token,
        'sizes': sizes,
        'path': path
      },
      onReset: function () {
        console.log('onReset')
      },
      onAfterImgCrop: function (data) {
        $('#img_'+name).prop('src',data.url);
        $('#b_apply_' + name).show();
        $('#b_delete_' + name).show();
      },
      onAfterImgUpload:function (data)
      {
        $('#b_apply_'+name).data("file_name",data.file_name);
        $('#b_delete_' + name).data("file_name", data.file_name);
      }
    };


    var cropperHeader = new Croppic('img_crop_'+name, options);

  }
  
  var images = $('.image_file');
  
  images.each(function (index) {
    console.log(index + ": " + $(this).data('name'));
    initCroppic($(this).data('name'));
  });
  
  $('.ba').on('click',function()
  {
      var id = this.id; 
      console.log(id);
      console.log($('#'+id).data('file_name'));
      console.log($('#' + id).data('sizes'));
      console.log($('#' + id).data('path'));
      
      $.post('/admin/images/apply',
            {
              name:$('#' + id).data('name'),
              file_name:$('#' + id).data('file_name'),
              path:$('#' + id).data('path'),
              sizes:$('#' + id).data('sizes'),
              _token:$('#' + id).data('token')
            },
            function (res)
            {
              if (res.status == 'success')
              {
                $('#'+res.element).val(res.file_name);
              }
              else
              {
                alert(res.message);
              }
            }
            );
    
    
  });
  
  
  
  
});

