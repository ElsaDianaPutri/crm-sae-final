<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class PointHistory extends Model
{

    use HasFactory;



    protected $primaryKey = 'id_point_history';



    protected $fillable = [

        'id_customer',
        'point',
        'type',
        'keterangan'

    ];



    public function customer()
    {

        return $this->belongsTo(
            Customer::class,
            'id_customer',
            'id_customer'
        );

    }


}