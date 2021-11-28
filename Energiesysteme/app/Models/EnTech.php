<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnTech extends Model
{
    use HasFactory;
    protected $table = 'EnTech';


    public function EnergiesystemeGesammt()
    {
        return $this->HasMany(EnSys::class);
    }

    public function EtPv()
    {
        return $this->belongsTo(EtPv::class);
    }
    public function EtAdAbKm()
    {
        return $this->belongsTo(EtAdAbKm::class);
    }
    public function EtBhKw()
    {
        return $this->belongsTo(EtBhKw::class);
    }
    public function EtBmHk()
    {
        return $this->belongsTo(EtBmHk::class);
    }
    public function EtBmHw()
    {
        return $this->belongsTo(EtBmHw::class);
    }
    public function EtBs()
    {
        return $this->belongsTo(EtBs::class);
    }
    public function EtBsZ()
    {
        return $this->belongsTo(EtBsZ::class);
    }
    public function EtEl()
    {
        return $this->belongsTo(EtEl::class);
    }
    public function EtGKbZ()
    {
        return $this->belongsTo(EtGKbZ::class);
    }
    public function EtGWbZ()
    {
        return $this->belongsTo(EtGWbZ::class);
    }
    public function EtHaZ()
    {
        return $this->belongsTo(EtHaZ::class);
    }
    public function EtKkM()
    {
        return $this->belongsTo(EtEtKkM::class);
    }
    public function EtKs()
    {
        return $this->belongsTo(EtKs::class);
    }
    public function EtSnB()
    {
        return $this->belongsTo(EtSnB::class);
    }
    public function EtStH()
    {
        return $this->belongsTo(EtStH::class);
    }
    public function EtWes()
    {
        return $this->belongsTo(EtWes::class);
    }
    public function EtWkA()
    {
        return $this->belongsTo(EtWkA::class);
    }
    public function EtWnB()
    {
        return $this->belongsTo(EtWnB::class);
    }
    public function EtWp()
    {
        return $this->belongsTo(EtWp::class);
    }
    public function EtWs()
    {
        return $this->belongsTo(EtWs::class);
    }
    
}
