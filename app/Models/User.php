<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function commentCount()
    {
        return $this->comments()->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likeCount()
    {
        return $this->likes()->count();
    }
    // public function friends()
    // {
    //     return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
    //         ->wherePivot('status', 'accepted')
    //         ->withPivot('status');
    // }

    // public function friendRequests()
    // {
    //     return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
    //         ->wherePivot('status', 'pending')
    //         ->withPivot('status');
    // }
    public function sentFriendRequests()
    {
        return $this->hasMany(Friend::class, 'user_id')->where('status', 'pending');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(Friend::class, 'friend_id')->where('status', 'pending');
    }

    public function friends()
    {
        return $this->hasMany(Friend::class, 'user_id')
            ->where('status', 'accepted')
            ->with('friend'); // Load the friend model
    }

    // public function friends()
    // {
    //     return Friend::where(function ($query) {
    //         $query->where('user_id', $this->id)
    //             ->orWhere('friend_id', $this->id);
    //     })->where('status', 'accepted')->with(['user', 'friend']);
    // }

    public function friendsCount()
    {
        return $this->friends()->count();
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }
    public function followersCount()
    {
        return $this->followers()->count();
    }

    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }
    public function followingCount()
    {
        return $this->following()->count();
    }
    public function followedUsers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function isFollowing($userId)
    {
        return Follower::where('user_id', $userId)->where('follower_id', $this->id)->exists();
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function unreadMessages()
    {
        return $this->receivedMessages()->where('is_read', false);
    }

    public function unreadMessagesCount()
    {
        if (!Auth::check()) {
            return 0;
        }

        return $this->unreadMessages()->count();
    }

    public function unreadNotificationsCount()
    {
        return $this->unreadNotifications()->count();
    }
}
