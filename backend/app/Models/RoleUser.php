<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoleUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_uuid',
        'role_uuid',
        'password_uuid',
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
        'uuid'
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
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'user_uuid');
    }

    public function password(): HasOne
    {
        return $this->hasOne(Password::class, 'uuid', 'password_uuid');
    }

    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'uuid', 'role_uuid');
    }
}
