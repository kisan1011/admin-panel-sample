<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    public $table = 'users';

    public $fillable = [
        'id', 'first_name', 'last_name', 'email', 'username', 'role', 'password', 'image'
    ];

     protected $hidden = [
        'password', 'remember_token','updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'email_verified_at' => 'date:Y-m-d H:i:s'
    ];

    protected $append = ['image'];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getFullname() {
        return $this->first_name.' '.$this->last_name;
    }

    public function getImageAttribute(){
        if (!$this->attributes['image']) {
            return 'public/profile/default.png';
        }
        return $this->attributes['image'];
    }
}
