<?php

namespace App\Models;

use EnTech;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnSys extends Model
{
    use HasFactory;
    protected $table = 'EnSys';



    public function Energiesysteme()
    {
        return $this->hasMany(User::class);
    }


    public function EnergietechnologienGesammt()
    {
        return $this->BelongsTo(EnTech::class);
    }
}
