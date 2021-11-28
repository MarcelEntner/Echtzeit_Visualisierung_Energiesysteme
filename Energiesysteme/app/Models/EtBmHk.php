<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtBmHk extends Model
{
    use HasFactory;

    protected $table = 'EtBmHk';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
