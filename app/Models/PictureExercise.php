<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 14:20
 */

namespace App\Models;


use App\ModelTypes\PictureExerciseType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PictureExercise extends Model
{
    protected $table = 'pictures_exercise';

    protected $fillable = [
        'exercise_id', 'path', 'extension', 'type'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function exercise(): HasOne
    {
        return $this->hasOne(Exercise::class, 'id', 'exercise_id');
    }

    public function setTypeAttribute($value)
    {
        if(in_array($value, $types = PictureExerciseType::getAll())) {
            throw new \InvalidArgumentException('Invalid type value. You can use: ', implode(', ', $types));
        }

        $this->attributes['type'] = $value;
    }
}