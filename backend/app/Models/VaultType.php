<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaultType extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'preferences'
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

    protected $casts = [
        'preferences' => 'array'
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
}
