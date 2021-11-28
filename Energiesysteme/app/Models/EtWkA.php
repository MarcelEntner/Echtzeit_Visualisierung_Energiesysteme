<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtWkA extends Model
{
    use HasFactory;

    protected $table = 'EtWkA';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
