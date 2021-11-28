<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtWnB extends Model
{
    use HasFactory;

    protected $table = 'EtWnB';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
