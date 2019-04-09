<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-09
 * Time: 13:26
 */

namespace App\Http\Controllers;


use App\Filters\Work\WorkFilter;
use App\Models\Work;

class StatisticController extends Controller
{
    public function work(\Request $request, WorkFilter $workFilter)
    {
        $work = Work::query();
        $filter = $workFilter->apply($work);
    }
}