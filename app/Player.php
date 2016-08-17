<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Player extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function token()
    {
      $userid=$this->id;
      $created_at=$this->created_at;
      $f_timestamp=$created_at->year.
                   $created_at->month.
                   $created_at->day.
                   $created_at->hour.
                   $created_at->minute.
                   $created_at->second;
      $userid=(string)$userid;
      $new_userid='';
      for($k=0;$k<strlen($userid);$k++)
      {
        $tmp_id=chr(97+strval($userid[$k]));
        $new_userid=$new_userid.$tmp_id;
      }
      $new_str='';
      for($i=0;$i<strlen($f_timestamp);$i++)
      {
        $tmp_str=chr(107+$f_timestamp[$i]);
        $new_str=$new_str.$tmp_str;
      }
      $token=$new_userid.'.'.$new_str;
      return $token;
    }
}
