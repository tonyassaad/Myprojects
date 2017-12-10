<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pages extends Model {

    protected $table = 'pages';
    public $timestamps = false;

    public function getDomains(){
        $this->belongsTo('App\Models\Domain');
    }
}
