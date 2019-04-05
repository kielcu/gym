<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-05
 * Time: 15:03
 */

namespace App\Repositories;


use App\Models\Muscle;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function create(Muscle $muscle)
    {
        $muscle->save();
    }

    public function updateById(int $id, Muscle $muscle)
    {
        Muscle::query()
            ->where('id', $id)
            ->update($muscle->toArray());
    }
}