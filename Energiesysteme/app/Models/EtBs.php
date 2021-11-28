<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtBs extends Model
{
    use HasFactory;
    protected $table = 'EtBs';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
