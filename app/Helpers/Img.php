<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Img
 *
 * @author зс
 */
class Img {
  //put your code here
  
 

 public static function show($name,$value,$path,$img_size,$sizes)
 {
    $img = self::get_width_height($img_size);
    $max_size_obj = self::get_max_size($sizes);
    
    //ppre($max_size_obj);
    
    $txt = "<div class='image_file row' data-name='$name'    >";
    $txt.= "<div class='col-md-5' >";
    $txt.= '<input type hidden id="val_'.$name.'" data-token="'.csrf_token().'" data-path=\''.$path.'\' data-sizes=\''. serialize($sizes).'\'   >';
    $txt.= '<input type="hidden" id="'.$name.'" name="'.$name.'" >';
    if ($value) 
    {
      $txt .= "<img src='$value' alt='image_$name' id='img_$name'  width='$img->width' height='$img->height'  >";
    } else {
      $txt .= '<img src="holder.js/'.$img_size.'" alt="..." id="img_'.$name.'"   class="img-thumbnail">';
    }
    $txt .= "</div>";
    $txt .= "<div class='col-md-2' >";
    $txt .= "<input type='button' class='btn btn-default bu' id='b_upload_$name' data-name='$name'   value='Upload image' >";
    $txt .= "<input type='button' data-token='".csrf_token()."' data-file_name='' data-sizes='".serialize($sizes)."' data-path='$path'   style='display:none'  class='btn btn-default bu ba' id='b_apply_$name'  data-name='$name'   value='Apply image' >";
    if ($value)
    {
      $txt .= "<input type='button' data-token='" . csrf_token() . "' data-file_name='$value' data-sizes='".serialize($sizes)."' data-path='$path'   class='btn btn-default bu bd' id='b_delete_$name' data-name='$name'   value='Delete image' >";
    }
    else {
      $txt .= "<input type='button' data-token='" . csrf_token() . "' data-file_name='' data-sizes='" . serialize($sizes) . "' data-path='$path'   style='display:none'  class='btn btn-default bu bd' id='b_delete_$name' data-name='$name'   value='Delete image' >";
    }
    
    $txt .= "</div>";
    $txt .= '<div id="img_crop_' .$name. '" style="position:absolute;display:none; width:'.$max_size_obj->width.'px; height:'.$max_size_obj->height.'px;" >';
    $txt .= "</div>";
    echo $txt;
 }
 
 private static function get_max_size($sizes)
 {
   $fe = reset($sizes);
   $first = self::get_width_height($fe);
   $max_w = $first->width;
   $max_obj = '';
   foreach ($sizes as $key=>$size)
   {
       $obj = self::get_width_height($size); 
       if ($obj->width>=$max_w)
       {
         $max_obj = $obj;
         $max_w = $obj->width;
       }
   }
   return $max_obj;
 }
 
 
  
 private static function get_width_height($str)
 {
    $obj = new stdClass(); 
    $mas = explode('x',$str);
    if (is_array($mas)&&isset($mas[0])&&isset($mas[1]))
    {
      $obj->width = $mas[0];
      $obj->height = $mas[1];
      $res = $obj;
    }
    else
    {
      $res = false;
    }
    return $res;
 }
  
}