<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtKs extends Model
{
    use HasFactory;

    protected $table = 'EtKs';
    
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
