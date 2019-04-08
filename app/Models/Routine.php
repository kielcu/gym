<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Routine extends Model
{
    protected $table = 'routines';

    protected $fillable = ['name'];

    protected $guarded = ['id'];

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(
            Exercise::class,
            'exercises_has_routine',
            'routine_id',
            'exercise_id',
            'id',
            'id'
        );
    }

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class, 'routine_id', 'id');
    }
}
