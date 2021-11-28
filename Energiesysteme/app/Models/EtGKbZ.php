<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtGKbZ extends Model
{
    use HasFactory;

    protected $table = 'EtGKbZ';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
