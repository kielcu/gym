<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2019-04-13
 * Time: 12:21
 */

namespace App\Repositories\Work;


use App\Filters\Filters;
use App\Models\Work;
use App\Repository\Work\Filters\WorkFilter;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

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


    /**
     * @return Collection|Work[]
     */
    public function filterWork(): Collection
    {
        $query = Work::query();

        return app(WorkFilter::class)->apply($query)->get();
    }
}