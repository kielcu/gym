<?php

namespace App\Http\Forms\Exercise;

use App\Mapper\Exercise\FromExerciseMapper;
use App\Models\Exercise;
use App\ModelTypes\PictureExerciseType;
use Illuminate\Support\Collection;
use Kris\LaravelFormBuilder\Form;

class ExerciseForm extends Form
{
    public function buildForm()
    {
        $this->setNameField();

        $this->setMusclesField();

        $this->add('video', 'text');

        foreach (PictureExerciseType::getAll() as $type) {
            $this->add('pictures['.$type.']', 'file', [
//            'default_value' => function() {
//                $this->getExercise()->pictures->first(function(PictureExercise $pictureExercise) {
//                    return $pictureExercise->type == PictureExerciseType::START;
//                });
//            }
            ]);
        }

        $this->add('submit', 'submit');
    }

    public function getExercise(): Exercise
    {
        return $this->getModel();
    }

    public function mapExercise(Exercise $exercise = null): Exercise
    {
        if (!$exercise) {
            $exercise = new Exercise();
        }

        return app(FromExerciseMapper::class)->map($exercise, $this->getFieldValues());
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
