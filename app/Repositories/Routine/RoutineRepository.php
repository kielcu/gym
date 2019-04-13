<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 12:06
 */

namespace App\Repositories\Routine;


use App\Models\Routine;

class RoutineRepository
{
    public function create(Routine $routine): Routine
    {
        $routine->save();

        return $routine;
    }

    public function update(Routine $routine): Routine
    {
        $routine->save();

        return $routine;
    }

    public function delete(Routine $routine)
    {
        $routine->delete();
    }
}