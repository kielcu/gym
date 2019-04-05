<?php

namespace App\Http\Forms\Exercise;

use App\Models\Exercise;
use Illuminate\Support\Collection;
use Kris\LaravelFormBuilder\Form;

class ExerciseForm extends Form
{
    public function buildForm()
    {
        $this->setNameField();

        $this->setMusclesField();

        $this->add('submit', 'submit');
    }

    /**
     * @return Collection|Exercise[]
     */
    protected function getMuscles(): Collection
    {
        return $this->getData('muscles');
    }

    protected function setNameField(): void
    {
        $this->add('name', 'text', [
            'rules' => [
                'required',
                'string',
//               Rule::unique('muscles')
            ]
        ]);
    }

    protected function setMusclesField(): void
    {
        $this->add('muscles', 'choice', [
            'expanded' => false,
            'multiple' => true,
            'choices' => $this->getMuscles()->pluck('name', 'id')->toArray(),
//            'rule' => [
//                'sometimes',
//                'array',
//                ''
//            ]
        ]);
    }
}
