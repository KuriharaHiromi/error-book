<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //
    protected $table = 'goods';

    protected $primaryKey = 'good_id';

    protected $fillable = ['answer_id','user_id','ip'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function answer() {
        return $this->belongsTo('App\Answer');
    }
}
