<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{

    use HasFactory, SoftDeletes;


    protected $primaryKey = 'id_customer';


    protected $fillable = [

        'id_user',
        'member_code',
        'qr_code',
        'nama',
        'nomor_hp',
        'email',
        'tanggal_lahir',
        'tanggal_daftar',
        'saldo_point',
        'status_member'

    ];


    protected $casts = [

        'tanggal_lahir'=>'date',
        'tanggal_daftar'=>'date'

    ];



    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }



    public function transactions()
    {
        return $this->hasMany(
            Transaction::class,
            'id_customer'
        );
    }



    public function pointHistories()
    {
        return $this->hasMany(
            PointHistory::class,
            'id_customer'
        );
    }



    public function redemptions()
    {
        return $this->hasMany(
            Redemption::class,
            'id_customer'
        );
    }

}