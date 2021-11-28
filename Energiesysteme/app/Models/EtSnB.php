<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtSnB extends Model
{
    use HasFactory;

    protected $table = 'EtSnB';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
