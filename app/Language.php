<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table = 'languages';
    protected $fillable = ['languages_id','languages_name'];
    public function error_r() {
        return $this->hasMany('App\Error_list');

    }

}
