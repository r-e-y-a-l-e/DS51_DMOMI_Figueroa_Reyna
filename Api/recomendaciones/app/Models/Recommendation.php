<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'place_id',
        'comment_id',
        'rating_id',
        'imagen'
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}