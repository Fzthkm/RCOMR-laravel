<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function region(){
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}
