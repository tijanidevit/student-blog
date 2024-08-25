<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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

    protected $attributes = [
        'role' => UserRoleEnum::STUDENT->value,
    ];

    // Relationships

    public function student() : HasOne {
        return $this->hasOne(Student::class);
    }

    public function posts() : HasMany {
        return $this->hasMany(Post::class);
    }


    public function getShowImageAttribute() : string {
        return $this->image ?? 'http://via.placeholder.com/280x280';
    }


    public function getShowAboutAttribute() : string {
        return $this->about ?? 'Bio not added yet!';
    }


    public function isAdmin() {
        return $this->role == UserRoleEnum::ADMIN->value;
    }
}
