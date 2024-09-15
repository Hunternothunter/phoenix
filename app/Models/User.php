<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'birthdate',
        'mobile_num',
        'username',
        'profile_picture',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the comments for the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the likes for the user.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likeCount()
    {
        return $this->likes()->count();
    }

    /**
     * Get the followers for the user.
     */
    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }

    /**
     * Get the users that the user is following.
     */
    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    /**
     * Get the messages sent by the user.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get the messages received by the user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Get the unread messages for the user.
     */
    public function unreadMessages()
    {
        return $this->receivedMessages()->where('is_read', false);
    }

    /**
     * Get the count of unread messages for the user.
     */
    public function unreadMessagesCount()
    {
        // Check if a user is authenticated using Auth::check()
        if (!Auth::check()) {
            return 0; // Return 0 if no user is logged in
        }

        // If the user is authenticated, count their unread messages
        return $this->unreadMessages()->count();
    }

    /**
     * Get the unread notifications count for the user.
     */
    public function unreadNotificationsCount()
    {
        return $this->unreadNotifications()->count();
    }
}
