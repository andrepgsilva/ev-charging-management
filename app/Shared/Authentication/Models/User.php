<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Database\Factories\UserFactory;
use App\Shared\Traits\RouteBindingTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property ?string $email_verified_at
 * @property string $token
 */
final class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, RouteBindingTrait;

    protected $hidden = ['password', 'remember_token'];

    public function personalToken(): ?string
    {
        // @phpstan-ignore-next-line
        return $this->tokens()->first()->token ?? null;
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
