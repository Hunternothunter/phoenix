<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'follower_id',
    ];

    /**
     * Get the user who is being followed.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who follows.
     */
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
