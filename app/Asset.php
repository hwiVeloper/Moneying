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

    public static function boot() {
        parent::boot();

        self::deleting(function ($value) {
            $value->accounts()->delete();
        });

        self::created(function ($value) {
            self::where('id', $value->id)->update(['amount' => $value->underlying]);
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function assetType() {
        return $this->belongsTo(AssetType::class, 'type');
    }

    public function accounts() {
        return $this->hasMany(Account::class);
    }
}
