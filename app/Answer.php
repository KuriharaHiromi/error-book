<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Answer extends Model
{
    //
    protected $table = 'answers';

    protected $primaryKey = 'answer_id';


    protected $fillable = ['answer_id','error_id','user_id','answer_name','answer_overview'];
    public function error_r() {
        return $this->belongsTo('App\Error_list');
    }
    public function goods() {
        return $this->hasMany(Good::class, 'answer_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function is_good_by_auth_user(){
        
      $id = Auth::id();
  
      $goods = array();

      foreach($this->goods as $good) {
        array_push($goods, $good->user_id);
      }


      
      if (in_array($id, $goods)) {
        return true;
      } else {
        return false;
      }
    }

}
