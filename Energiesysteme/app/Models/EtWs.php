<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtWs extends Model
{
    use HasFactory;

    protected $table = 'EtWs';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
