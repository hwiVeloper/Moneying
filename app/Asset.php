<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public static $rules = [
        'type' => ['required'],
        'name' => ['required'],
        'underlying' => ['required', 'min:2']
    ];

    protected $fillable = [
        'type',
        'name',
        'underlying',
        'amount',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function assetType() {
        return $this->belongsTo(AssetType::class, 'type');
    }
}
