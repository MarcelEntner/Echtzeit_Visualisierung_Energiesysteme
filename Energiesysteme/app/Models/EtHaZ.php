<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtHaZ extends Model
{
    use HasFactory;

    protected $table = 'EtHaZ';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
