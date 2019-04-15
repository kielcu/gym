<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    protected $table = 'exercises';

    protected $fillable = [
        'name', 'video'
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

    public function routines(): BelongsToMany
    {
        return $this->belongsToMany(
            Routine::class,
            'exercises_has_routine',
            'exercise_id',
            'routine_id',
            'id',
            'id'
        );
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class, 'exercise_id', 'id');
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(PictureExercise::class, 'exercise_id', 'id');
    }
}
