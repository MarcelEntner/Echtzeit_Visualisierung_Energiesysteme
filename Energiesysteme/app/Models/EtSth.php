<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtSth extends Model
{
    use HasFactory;

    protected $table = 'EtSth';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
