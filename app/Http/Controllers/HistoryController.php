<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-09
 * Time: 13:43
 */

namespace App\Http\Controllers;


use App\Models\Training;

class HistoryController extends Controller
{
    public function index()
    {
        return Training::query()->with('routine', 'works.exercise')->limit(10)->get();
    }

    public function month($id)
    {
        return Training::query()->with('routine')
            ->where('created_at', '>', $id)
            ->where('finished_at', '<', $id)
            ->get();
    }
}