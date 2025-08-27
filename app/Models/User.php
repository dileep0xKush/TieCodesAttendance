<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->slug = $user->generateUniqueString('slug', 'users');
        });
    }

    public function generateUniqueString($column, $table)
    {
        do {
            $uniqueString = $this->generateRandomString(60);
        } while (DB::table($table)->where($column, $uniqueString)->exists());

        return $uniqueString;
    }

    public function generateRandomString($length)
    {
        $characters = 'b1L2p3G4w5Q6u1Z9t7K8l5V4C2j5a6m6X9n0i1R3A5h6v7Z8c9I2F6f7E9T2N4D7o2W0H1e4Y6M2B3z7P9q1r6S8w1U6k9d4y1x5g';
        return substr(str_shuffle(str_repeat($characters, ceil($length / strlen($characters)))), 0, $length);
    }
}
