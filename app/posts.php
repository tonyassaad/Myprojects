<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
       public $timestamps = false;
       public function getPage(){
           return $this->belongsTo('App\Models\pages');
       }
}
