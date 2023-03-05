<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'body', 'featured_image_path'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}