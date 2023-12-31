<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function like(Question $question): void
    {
        $this->votes()->create([
            'question_id' => $question->id,
            'like' => true,
        ]);
    }

    public function unlike(Question $question): void
    {
        $this->votes()->create([
            'question_id' => $question->id,
            'unlike' => true,
        ]);
    }

    public function liked(Question $question): bool
    {
        if ($this->votes()->where('question_id', $question->id)->where('like', true)->exists()) {
            return true;
        }

        return false;
    }

    public function unliked(Question $question): bool
    {
        if ($this->votes()->where('question_id', $question->id)->where('unlike', true)->exists()) {
            return true;
        }

        return false;
    }
}
