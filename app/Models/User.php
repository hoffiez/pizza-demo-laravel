<?php

namespace App\Models;

use App\Traits\HasJWT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema(
 *  ref="Authtoken",
 *  title="Authtoken",
 *  @OA\Property(
 *      property="auth_token",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="expires_in",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="token_type",
 *      type="string"
 *  )
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasJWT;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
