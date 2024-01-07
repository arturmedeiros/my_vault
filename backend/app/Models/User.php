<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    // Método para definir o tempo de validade do token
    public function getTTL(): int
    {
        return 1440; // Defina o tempo de validade do token em minutos (exemplo: 24 horas)
    }
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'avatar',
        'phone',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'preferences',
        'status_key',
        'recovery_token',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'created_date',
        'created_time',
        'updated_date',
        'updated_time',
        'key',
    ];

    protected $hidden = [
        'id',
        'uuid',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'phone_verified_at' => 'datetime',
        'preferences' => 'array',
    ];

    /* Attributes */
    public function getCreatedDateAttribute(): string
    {
        return "{$this->created_at->format('d/m/Y')}" ;
    }

    public function getCreatedTimeAttribute(): string
    {
        return "{$this->created_at->format('H:i')}" ;
    }

    public function getUpdatedDateAttribute(): string
    {
        return "{$this->updated_at->format('d/m/Y')}" ;
    }

    public function getUpdatedTimeAttribute(): string
    {
        return "{$this->updated_at->format('H:i')}" ;
    }

    public function getKeyAttribute(): string
    {
        return "{$this->uuid}" ;
    }

    // Relationships
    public function roles(): HasMany
    {
        return $this->hasMany(RoleUser::class, 'user_uuid', 'uuid')
            ->join('roles', 'role_users.role_uuid', '=', 'roles.uuid')
            ->select('roles.*', 'role_users.*');
    }
}
