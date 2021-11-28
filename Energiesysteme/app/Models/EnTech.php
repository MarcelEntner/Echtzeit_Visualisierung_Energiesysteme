<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnTech extends Model
{
    use HasFactory;
    protected $table = 'EnTech';


    public function Energiesysteme()
    {
        return $this->HasMany(EnSys::class);
    }

    public function EtPV()
    {
       // return $this->belongsTo()
    }
}
