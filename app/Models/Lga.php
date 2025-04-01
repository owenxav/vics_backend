<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lga extends Model
{
    use HasFactory, HasUlids, SoftDeletes;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
