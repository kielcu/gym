<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Muscle extends Model
{
    protected $table = 'muscles';

    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(
            Exercise::class,
            'exercises_has_muscles',
            'exercise_id',
            'muscle_id',
            'id',
            'id'
        );
    }
}
