<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Training extends Model
{
    protected $table = 'trainings';

    protected $fillable = ['routine_id', 'finished_at'];

    protected $guarded = ['id'];

    public function routine(): BelongsTo
    {
        return $this->belongsTo(Routine::class, 'routine_id', 'id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class, 'training_id', 'id');
    }
}
