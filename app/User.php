<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function goods()
    {
        return $this->belongsToMany('App\Good','goods','user_id','answer_id')->withTimestamps();
    }

    public function isgood($answerId)
    {
      return $this->goods()->where('answer_id',$answerId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function good($answerId)
    {
      if($this->isgood($answerId)){
        //もし既に「いいね」していたら何もしない
      } else {
        $this->goods()->attach($answerId);
      }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function ungood($answerId)
    {
      if($this->isgood($answerId)){
        //もし既に「いいね」していたら消す
        $this->goods()->detach($answerId);
      } else {
      }
    }

}
