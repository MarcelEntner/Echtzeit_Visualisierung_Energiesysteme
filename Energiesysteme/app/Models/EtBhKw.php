<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtBhKw extends Model
{
    use HasFactory;
    protected $table = 'EtBhKw';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
