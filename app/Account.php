<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public static $rules = [
        'type' => ['required'],
        'category_id' => ['required'],
        'asset_id' => ['required'],
        'amount' => ['required']
    ];

    protected $fillable = [
        'type',
        'date',
        'description',
        'amount',
        'user_id',
        'category_id',
        'asset_id'
    ];

    public static function boot() {
        parent::boot();

        self::created(function ($value) {
            $value->asset()->where('id', $value->asset_id)
                           ->update(['amount' => $value->asset->amount + ($value->type == 1 ? $value->amount : ( $value->amount * -1 ) )]);
        });
    }

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
