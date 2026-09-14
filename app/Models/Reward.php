<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Reward extends Model
{

    use HasFactory;


    protected $primaryKey='id_reward';



    protected $fillable=[

        'reward_name',
        'description',
        'image_path',
        'point_required',
        'stock',
        'status'

    ];



    public function redemptions()
    {

        return $this->hasMany(
            Redemption::class,
            'id_reward',
            'id_reward'
        );

    }

}