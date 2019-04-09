<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-09
 * Time: 13:31
 */

namespace App\Filters\Work;


use App\Filters\Filters;

class WorkFilter extends Filters
{
    protected $filters = [
        'exercise',
        'muscle',
        'routine',
        'start',
        'end'
    ];

    public function exercise(int $id)
    {
        $this->builder->where('exercise_id', $id);
    }

    public function muscle(int $id)
    {
        $this->builder->whereRaw('exercises_id in (Select exercise_id From exercises_has_muscles where muscle_id = ' . $id . ')');
    }

    public function routine($id)
    {
        $this->builder->whereRaw('training_id  = (Select exercise_id From trainings where routine_id = ' . $id . ' limit 1)');
    }

    public function start($date)
    {
        $this->builder->whereRaw('training_id in (Select id From trainings WHERE created_at >= ' . $date . ')');
    }

    public function end($date)
    {
        $this->builder->whereRaw('training_id in (Select id From trainings WHERE finished_at <= ' . $date . ')');
    }
}