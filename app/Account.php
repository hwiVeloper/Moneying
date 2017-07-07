<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'type',
        'date',
        'description',
        'amount',
        'user_id',
        'category_id',
        'asset_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function asset() {
        return $this->belongsTo(Asset::class);
    }
}
