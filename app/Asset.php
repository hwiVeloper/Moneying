<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'type',
        'name',
        'amount',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
