<?php

namespace App\Models;

use App\Helpers\CryptoService;
use App\Helpers\HelperClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'pass',
        'login',
        'preferences',
        'status_key',
        'user_key',
        'type_key',
        'img',
        'deleted_at',
    ];

    protected $appends = [
        'pass_decrypt',
        'pass_level',
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

    protected $casts = [
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

    public function getPassDecryptAttribute(): string
    {
        return CryptoService::decryptPassword($this->pass, HelperClass::getAppKey()) ?? '';
    }

    public function getPassLevelAttribute(): string
    {
        return HelperClass::verificarNivelSegurancaSenha(CryptoService::decryptPassword($this->pass, HelperClass::getAppKey())) ?? 1;
    }

    // Relationships
    public function roles(): HasMany
    {
        return $this->hasMany(RoleUser::class, 'password_uuid', 'uuid');
    }

    public function type(): BelongsTo
    {
        return $this->BelongsTo(VaultType::class, 'type_key', 'uuid');
    }
}
