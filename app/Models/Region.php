<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function organisations(){
        return $this->hasMany(Organisation::class, 'organisation_id', 'id');
    }
}
