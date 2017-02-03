<?php

namespace App;

use App\User;
use App\Like;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['body'];

    protected $appends = ['likeCount', 'likedByCurrentUser', 'canBeLikedByCurrentUser'];

    // Scopes
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Attibutes
    public function getLikeCountAttribute()
    {
        return $this->likes->count();
    }

    public function getLikedByCurrentUserAttribute()
    {
        return $this->likes->where('user_id', Auth::user()->id)->count() === 1;
    }

    public function getCanBeLikedByCurrentUserAttribute()
    {
        return $this->user->id !== Auth::user()->id;
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
