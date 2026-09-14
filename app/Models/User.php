<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory;


    /**
     * Primary Key
     */
    protected $primaryKey = 'id_user';


    /**
     * Field yang boleh diisi
     */
    protected $fillable = [
        'username',
        'password',
        'role',
        'status'
    ];


    /**
     * Field yang disembunyikan saat response API
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];


    /**
     * Casting data
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



    /**
     * Relasi:
     * User memiliki satu Customer
     */
    public function customer()
    {
        return $this->hasOne(
            Customer::class,
            'id_user',
            'id_user'
        );
    }
}