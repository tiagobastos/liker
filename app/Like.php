<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id'
    ];

    // Same name as polymorphic name
    public function likeable()
    {
        return $this->morphTo();
    }
}
