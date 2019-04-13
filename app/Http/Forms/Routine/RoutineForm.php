<?php

namespace App\Http\Forms\Routine;

use App\Models\Routine;
use Kris\LaravelFormBuilder\Form;

class RoutineForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text');
        $this->add('submit','submit');
    }

    public function mapRoutine(Routine $routine = null): Routine
    {
        if (!$routine) {
            $routine = new Routine();
        }

        $routine->fill($this->getFieldValues());

        return $routine;
    }
}
