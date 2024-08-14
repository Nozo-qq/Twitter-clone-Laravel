<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\Idea;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'bio',
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
            // 'password' => 'hashed', // No need for this hash bcz I use hashing function in usercontroller
        ];
    }

    public function ideas() {
        return $this->hasMany(Idea::class)->latest();
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

    public function followings() {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
    }

    public function followers() {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }

    public function follows(User $user) {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    public function likes() {
        return $this->belongsToMany(Idea::class, 'idea_like')->withTimestamps();
    }
    public function hasLikedIdea(Idea $idea) {
        //     if($this === null) {
        //     return false;
        // }
        return DB::table('idea_like')
                         ->where('user_id', $this->id)
                         ->where('idea_id', $idea->id)
                         ->exists();
    }

    // public function getUsersNotFollowedByMe() {
    //     $user_id = $this->id;
    //     $users = DB::table('users')
    //                 ->where('id', '<>', $user_id)
    //                 ->whereNotIn('id', function($query) use ($user_id){
    //                     $query->select('user_id')
    //                           ->from('follower_user')
    //                           ->whereRaw('follower_id = ?', [$user_id]);
    //                 });

    //     return $users;
    // }

    public function getImageURL() {
        if($this->image) {
            return url('storage/'.$this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->name}";
    }
}
