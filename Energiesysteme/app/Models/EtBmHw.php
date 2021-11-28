<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtBmHw extends Model
{
    use HasFactory;
    protected $table = 'EtBmHw';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
