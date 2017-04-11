<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Response;
use stdClass;

class ImagesController extends Controller {

  //
  public function __construct() {

    $this->middleware('auth');
  }

  public function upload() {
    $form_data = Input::all();

    $validator = Validator::make($form_data, ['img' => 'required|mimes:png,gif,jpeg,jpg,bmp'], [
        'img.mimes' => 'Uploaded file is not in image format',
        'img.required' => 'Image is required'
        ]
    );

    if ($validator->fails()) {

      return Response::json([
          'status' => 'error',
          'message' => $validator->messages()->first(),
          ], 200);
    }

    $this->directory('uploads/temp');

    $photo = $form_data['img'];

    $original_name = $photo->getClientOriginalName();
    $original_name_without_ext = substr($original_name, 0, strlen($original_name) - 4);

    $filename = $this->sanitize($original_name_without_ext);
    $allowed_filename = $this->createUniqueFilename($filename);

    $filename_ext = $allowed_filename . '.jpg';

    $manager = new ImageManager();

    $image = $manager->make($photo)->encode('jpg')->save(env('UPLOAD_PATH_TEMP') . $filename_ext);


    if (!$image) {

      return Response::json([
          'status' => 'error',
          'message' => 'Server error while uploading',
          ], 200);
    }

    return Response::json([
        'status' => 'success',
        'url' => '/uploads/temp/' . $filename_ext,
        'file_name' => $filename_ext,
        'width' => $image->width(),
        'height' => $image->height()
        ], 200);
  }

  public function crop() {
    $form_data = Input::all();
    $image_url = base_path() . '/public' . $form_data['imgUrl'];

    $sizes = unserialize($form_data['sizes']);

    // resized sizes
    $imgW = $form_data['imgW'];
    $imgH = $form_data['imgH'];
    // offsets
    $imgY1 = $form_data['imgY1'];
    $imgX1 = $form_data['imgX1'];
    // crop box
    $cropW = $form_data['width'];
    $cropH = $form_data['height'];
    // rotation angle
    $angle = $form_data['rotation'];

    $filename_array = explode('/', $image_url);
    $filename = $filename_array[sizeof($filename_array) - 1];

    $manager = new ImageManager();
    $image = $manager->make($image_url);
    $image->resize($imgW, $imgH)
      ->rotate(-$angle)
      ->crop($cropW, $cropH, $imgX1, $imgY1)
      ->save(env('UPLOAD_PATH_TEMP') . $filename);

    foreach ($sizes as $key => $value) {
      $obj = $this->get_width_height($value);
      if ($obj) {
        $image->resize($obj->width, $obj->height)->save(env('UPLOAD_PATH_TEMP') . $key . '-' . $filename);
      }
    }


    if (!$image) {

      return Response::json([
          'status' => 'error',
          'message' => 'Server error while uploading',
          ], 200);
    }

    return Response::json([
        'status' => 'success',
        'url' => '/uploads/temp/' . $filename
        ], 200);
  }

  public function apply() {
    $input = Input::all();
    $element_name = $input['name'];
    $file_name = $input['file_name'];
    $sizes = $input['sizes'];
    $path = $input['path'];

    $manager = new ImageManager();
    $sizes_arr = unserialize($sizes);

    if (is_array($sizes_arr)) {
      $base_path = base_path() . '/public/uploads';
      try {
        foreach ($sizes_arr as $key => $value) {
          if (file_exists($base_path . '/temp/' . $key . '-' . $file_name)) {
            //ppr('uploads' . '/' . $path . '/' . $key);

            $this->directory('uploads' . '/' . $path . '/' . $key);
            if (copy($base_path . '/temp/' . $key . '-' . $file_name, $base_path . '/' . $path . '/' . $key . '/' . $file_name)) {
              unlink($base_path . '/temp/' . $key . '-' . $file_name);
            }
          }
        }
        if (file_exists($base_path . '/temp/' . $file_name)) {
          unlink($base_path . '/temp/' . $file_name);
        }
      } catch (\Exception $e) {
        $message = $e->getMessage();
        $status = 'error';
        return Response::json(['status' => $status, 'message' => $message]);
      }
    }

    return Response::json(['status' => 'success', 'element' => 'logo', 'file_name' => $file_name]);
  }

  private function directory($path) {
    $mas = explode('/', $path);

    $bpath = base_path() . '/public';
    foreach ($mas as $p) {
      if ($p) {
        $bpath .= '/' . $p;
        if ($p == 'tumb')
        // ppr($bpath);
        //ppr($bpath);
          if (!file_exists($bpath)) {
            //ppr($bpath);
            mkdir($bpath, 0777);
          } else {
            // ppre('ffff');
          }
      }
    }
  }

  private function get_width_height($str) {
    $obj = new stdClass();
    $mas = explode('x', $str);
    if (is_array($mas) && isset($mas[0]) && isset($mas[1])) {
      $obj->width = $mas[0];
      $obj->height = $mas[1];
      $res = $obj;
    } else {
      $res = false;
    }
    return $res;
  }

  private function sanitize($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
      "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
      "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

    return ($force_lowercase) ?
      (function_exists('mb_strtolower')) ?
      mb_strtolower($clean, 'UTF-8') :
      strtolower($clean) :
      $clean;
  }

  private function createUniqueFilename($filename) {
    $upload_path = env('UPLOAD_PATH_TEMP');
    $full_image_path = $upload_path . $filename . '.jpg';

    if (File::exists($full_image_path)) {
      // Generate token for image
      $image_token = substr(sha1(mt_rand()), 0, 5);
      return $filename . '-' . $image_token;
    }

    return $filename;
  }
}