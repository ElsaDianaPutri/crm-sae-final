<?php


namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Transaction extends Model
{

    use HasFactory;



    protected $primaryKey = 'id_transaction';



    protected $fillable = [

        'id_customer',
        'kode_transaksi',
        'tanggal_transaksi',
        'total_belanja',
        'point_didapat',
        'status',
        'source',
        'external_transaction_id'

    ];



    protected $casts = [

        'tanggal_transaksi' => 'datetime'

    ];



    /*
     * Transaction dimiliki oleh satu Customer
     */

    public function customer()
    {

        return $this->belongsTo(
            Customer::class,
            'id_customer',
            'id_customer'
        );

    }


}