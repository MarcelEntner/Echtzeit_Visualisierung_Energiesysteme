<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtAdAbKm extends Model
{
    use HasFactory;
    protected $table = 'EtAdAbKm';


    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
