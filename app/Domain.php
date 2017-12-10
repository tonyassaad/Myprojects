<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model {

    //
    protected $table = 'domains';
    public $timestamps = false;
    
    public function getPages(){
        return $this->hasMany('App\Models\pages');
    }
}
