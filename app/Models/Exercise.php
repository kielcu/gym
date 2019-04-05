<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercise extends Model
{
    protected $table = 'exercises';

    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function muscles(): BelongsToMany
    {
        return $this->belongsToMany(
            Muscle::class,
            'exercises_has_muscles',
            'exercise_id',
            'muscle_id',
            'id',
            'id'
        );
    }
}
