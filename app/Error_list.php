<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error_list extends Model
{
    //
    protected $table = 'error_lists';
    protected $fillable = ['error_id','languages_id','user_id','error_name','overview'];
    public function language_r() {
        return $this->belongsTo('App\Language');
    }

    public function answer_r() {
        return $this->hasMany('App\Answer');

    }
}
