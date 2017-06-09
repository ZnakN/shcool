<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Trainings;

class Lessons extends Model
{
     protected $table = 'lessons';
    
    protected $fillable = [
     'name', 'description', 'training_id','image','status', 'meta_title','meta_description','meta_keywords','url','price'
    ];
    // , 'date_created'
    public function setUrlAttribute($value) {
      if (!$value)
      {
        $this->attributes['url'] = $this->translit($this->attributes['name']);
      }
      else
      {
        $this->attributes['url'] = preg_replace('/\s+/', '', $this->translit($value));
      }
  }

    public function training()
    {
       return $this->hasOne('App\Models\Trainings','id','training_id');
    }
    
    
    private function translit($str) {
      $translit = array(
        "А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d", "Е" => "e", "Ё" => "e", "Ж" => "zh", "З" => "z", "И" => "i", "Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n", "О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t", "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch", "Ш" => "sh", "Щ" => "shch", "Ъ" => "", "Ы" => "y", "Ь" => "", "Э" => "e", "Ю" => "yu", "Я" => "ya",
        "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "e", "ж" => "zh", "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "shch", "ъ" => "", "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
        "A" => "a", "B" => "b", "C" => "c", "D" => "d", "E" => "e", "F" => "f", "G" => "g", "H" => "h", "I" => "i", "J" => "j", "K" => "k", "L" => "l", "M" => "m", "N" => "n", "O" => "o", "P" => "p", "Q" => "q", "R" => "r", "S" => "s", "T" => "t", "U" => "u", "V" => "v", "W" => "w", "X" => "x", "Y" => "y", "Z" => "z"
      );
      $result = strtr($str, $translit);
      $result = preg_replace("/[^a-zA-Z0-9_]/i", "-", $result);
      $result = preg_replace("/\-+/i", "-", $result);
      $result = preg_replace("/(^\-)|(\-$)/i", "", $result);
      return $result;
}
}
