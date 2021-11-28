<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtBsZ extends Model
{
    use HasFactory;

    protected $table = 'EtBsZ';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
