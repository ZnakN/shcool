<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
     protected $table = 'discounts';
    
    protected $fillable = [
    'training_id','code','status','value',
    ];
    
    public function training() {
    return $this->hasOne('App\Models\Trainings', 'id', 'training_id');
  }
}
