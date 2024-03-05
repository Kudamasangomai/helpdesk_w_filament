<?php

namespace App\Models;

use App\Enums\RepairStatus;
use App\Models\User;
use App\Models\asset;
use App\Models\fault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repair extends Model
{
    use HasFactory;

    public function assignedto()
    {
        return $this->belongsto(User::class ,'assigneduser_id');
    }
    public function user()
    {
        return $this->belongsto(User::class);
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

    protected $casts = [
        'status' =>  RepairStatus::class,
    ];

}
