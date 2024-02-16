<?php

namespace App\Models;

use App\Models\User;
use App\Models\asset;
use App\Models\fault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repair extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function asset()
    {
        return $this->belongsTo(asset::class);
    }

    public function fault()
    {
        return $this->belongsTo(fault::class);
    }
    public function closedby()
    {
        return $this->belongsTo(User::class,'closeby');
    } 
    

}
