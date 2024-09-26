<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'filename', 'user_id']; // Ensure user_id is fillable

    public function user()
    {
        return $this->belongsTo(User::class); // Define relationship with User model
    }
}
