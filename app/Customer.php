<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
 use Spatie\Permission\Traits\HasRoles;
class Customer extends Model
{

/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
'name', 'phone', 'address','identity'
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
'roles_name' => 'array',

];
}
