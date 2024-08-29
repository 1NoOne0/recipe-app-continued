<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'email', 'password', 'role', 'bio', 'profile_picture',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    // Relationships
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'author', 'id'); // Change 'author' to reference 'id'
    }

    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
                    ->withPivot('status', 'started_at')
                    ->wherePivot('status', 'accepted'); // Adjust status accordingly
    }

    public function acceptedFriends(): BelongsToMany
    {
        return $this->friends()->wherePivot('status', 'accepted');
    }


    public function reviews()
    {
        return $this->hasMany(Review::class, 'author_id', 'id'); // Change to reference 'id'
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
