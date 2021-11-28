<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtPv extends Model
{
    use HasFactory;

    
    protected $table = 'EtPv';
    

    public function EntechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
