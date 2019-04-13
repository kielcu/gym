<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 12:21
 */

namespace App\Repositories\Work;


use App\Models\Work;

class WorkRepository
{
    public function create(Work $work): Work
    {
        $work->save();

        return $work;
    }

    public function update(Work $work): Work
    {
        $work->save();

        return $work;
    }

    public function delete(Work $work): void
    {
        $work->delete();
    }
}