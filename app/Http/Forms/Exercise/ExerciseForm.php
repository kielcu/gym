<?php

namespace App\Http\Forms\Exercise;

use App\Models\Exercise;
use App\Models\Muscle;
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

    public function mapExercise(Exercise $exercise = null): Exercise
    {
        if (!$exercise) {
            $exercise = new Exercise();
        }

        $exercise->fill($this->getFieldValues());

        $muscles = collect([]);
        foreach ($this->getFieldValues()['muscles'] as $value) {
            $muscle = new Muscle();
            $muscle->id = $value;

            $muscles->push($muscle);
        }

        $exercise->setRelations([
            'muscles' => $muscles
        ]);

        return $exercise;
    }

    /**
     * @return Collection|Exercise[]
     */
    protected function getMuscles(): Collection
    {
        return $this->getData('muscles') ?? new Collection([]);
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
