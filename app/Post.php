<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = ['body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
