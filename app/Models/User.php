<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Sortable;
    public $sortable = ['name','username','created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'role',
        'profile_photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function developers() 
    {
        return $this->belongsToMany(Developer::class);
    }

    public function dpds() 
    {
        return $this->belongsToMany(Dpd::class);
    }    

    public function dpps() 
    {
        return $this->belongsToMany(Dpp::class);
    }

    public function banks() 
    {
        return $this->belongsToMany(Bank::class);
    }    

}
