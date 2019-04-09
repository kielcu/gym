<?php

namespace App\Http\Forms\Routine;

use Kris\LaravelFormBuilder\Form;

class RoutineForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text');
        $this->add('submit','submit');
    }
}
