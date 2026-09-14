<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Redemption extends Model
{

    use HasFactory;



    protected $primaryKey='id_redemption';



    protected $fillable=[

        'id_customer',
        'id_reward',
        'redeem_date',
        'point_used',
        'status',
        'redemption_code'

    ];



    protected $casts=[

        'redeem_date'=>'datetime'

    ];



    public function customer()
    {

        return $this->belongsTo(
            Customer::class,
            'id_customer',
            'id_customer'
        );

    }



    public function reward()
    {

        return $this->belongsTo(
            Reward::class,
            'id_reward',
            'id_reward'
        );

    }


}