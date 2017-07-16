<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    // protected $table = 'asset_types';

    protected $fillable = [
        'name'
    ];

    public function assets() {
        return $this->hasMany(Asset::class);
    }
}
