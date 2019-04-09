<?php

namespace App\Http\Forms\Work;

use Kris\LaravelFormBuilder\Form;

class WorkForm extends Form
{
    public function buildForm()
    {
        $this->add('training_id', 'hidden', [
            'rules' => [
                'required',
                'numeric',
                'exists:trainings,id'
            ]
        ]);

        $this->add('exercise_id', 'hidden', [
            'rules' => [
                'required',
                'numeric',
                'exists:exercises,id'
            ]
        ]);

        $this->add('series', 'number', [
            'rules' => [
                'required',
                'numeric',
            ]
        ]);

        $this->add('weight', 'number', [
            'rules' => [
                'required',
                'numeric',
            ]
        ]);

        $this->add('repeat', 'number', [
            'rules' => [
                'required',
                'numeric',
            ]
        ]);

        $this->add('rest', 'number', [
            'rules' => [
                'required',
                'numeric',
            ]
        ]);

        $this->add('description', 'text', [
            'rules' => [
                'sometimes',
            ]
        ]);
    }
}
