<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    protected $table = 'asset_types';

    public function assets() {
        return $this->hasMany(Asset::class);
    }
}
