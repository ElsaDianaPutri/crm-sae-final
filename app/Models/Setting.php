<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{

protected $primaryKey='id_setting';


protected $fillable=[

'setting_name',
'setting_value',
'description'

];


}