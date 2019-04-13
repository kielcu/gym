<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-09
 * Time: 13:26
 */

namespace App\Http\Controllers;


use App\Repositories\Work\WorkRepository;

class StatisticController extends Controller
{
    public function work(WorkRepository $workRepository)
    {
        $filters = $workRepository->filterWork();
    }
}