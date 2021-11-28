<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtWes extends Model
{
    use HasFactory;

    protected $table = 'EtWes';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
