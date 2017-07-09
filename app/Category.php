<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];

    public function accounts() {
        return $this->hasMany(Account::class);
    }
}
