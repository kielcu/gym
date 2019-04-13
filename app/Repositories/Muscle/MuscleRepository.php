<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-05
 * Time: 15:03
 */

namespace App\Repositories\Muscle;


use App\Models\Muscle;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class MuscleRepository
{
    /**
     * @param int $id
     * @return Muscle
     *
     * @throws ModelNotFoundException
     */
    public function findById(int $id): Muscle
    {
        return Muscle::query()->findOrFail($id);
    }

    public function create(Muscle $muscle): Muscle
    {
        $muscle->save();

        return $muscle;
    }

    public function updateById(int $id, Muscle $muscle)
    {
        Muscle::query()
            ->where('id', $id)
            ->update($muscle->toArray());
    }

    /**
     * @return Collection|Muscle[]
     */
    public function getAllForSelect(): Collection
    {
        return Muscle::query()->select('id', 'name')->get();
    }

    public function update(Muscle $muscle): Muscle
    {
        $muscle->save();

        return $muscle;
    }

    public function delete(Muscle $muscle): void
    {
        $muscle->delete();
    }
}