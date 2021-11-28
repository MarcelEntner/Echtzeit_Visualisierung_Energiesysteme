<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtGWbZ extends Model
{
    use HasFactory;

    protected $table = 'EtGWbZ';
    public function EnTechGem()
    {
        return $this->hasOne(EnTech::class);
    }
}
