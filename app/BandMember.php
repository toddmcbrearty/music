<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BandMember extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'band_id',
        'status',
    ];
}
