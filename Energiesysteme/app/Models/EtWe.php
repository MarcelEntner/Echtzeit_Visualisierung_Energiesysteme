<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtWe extends Model
{
    use HasFactory;

    protected $table = 'EtWe';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
