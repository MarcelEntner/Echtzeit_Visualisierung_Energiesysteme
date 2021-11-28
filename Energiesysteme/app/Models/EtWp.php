<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtWp extends Model
{
    use HasFactory;

    protected $table = 'EtWp';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
