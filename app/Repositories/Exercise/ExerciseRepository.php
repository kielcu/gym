<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 09:23
 */

namespace App\Repositories\Exercise;


use App\Models\Exercise;
use Illuminate\Support\Collection;

class ExerciseRepository
{
    /**
     * @var Exercise
     */
    private $exercise;

    public function __construct(Exercise $exercise)
    {
        $this->exercise = $exercise;
    }

    public function create(Exercise $exercise): Exercise
    {
        $exercise->save();

        return $exercise;
    }

    public function createWithRelations(Exercise $exercise): Exercise
    {
        $exercise = $this->create($exercise);
        $this->createRelationMuscles($exercise);

        return $exercise;
    }

    public function createRelationMuscles(Exercise $exercise)
    {
        if ($muscles = $exercise->getRelation('muscles')) {
            /** @var Collection $muscles */
            $exercise->muscles()->attach($muscles->pluck('id'));
        }
    }

    public function update(Exercise $exercise): Exercise
    {
        $exercise->save();

        return $exercise;
    }

    public function updateWithRelations(Exercise $exercise): Exercise
    {
        $exercise = $this->update($exercise);
        $this->updateRelationMuscles($exercise);

        return $exercise;
    }

    public function updateRelationMuscles(Exercise $exercise): Exercise
    {
        \DB::transaction(function() use($exercise) {
            $exercise->muscles()->detach();

            $this->createRelationMuscles($exercise);
        });

        return $exercise;
    }

    public function delete(Exercise $exercise)
    {
        $exercise->delete();
    }
}