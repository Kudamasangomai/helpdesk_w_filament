<?php

namespace App\Models;

use App\Models\Repair;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class fault extends Model
{
    use HasFactory ,Sluggable;

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public  function sluggable(): array
    {
        return [
            'slug'=>[
                'source' => 'name',
                'onUpdate'=> true,  
                          ]
            ];
    }

}
