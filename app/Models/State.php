<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, HasUlids, SoftDeletes;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
