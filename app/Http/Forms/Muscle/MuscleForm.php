<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-05
 * Time: 13:07
 */

namespace App\Http\Forms\Muscle;


use App\Models\Muscle;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class MuscleForm extends Form
{
    public function buildForm()
    {
        $this->setNameField();

        $this->add('submit', 'submit');
    }

    public function mapMuscle(Muscle $muscle): Muscle
    {
        if (!$muscle) {
            $muscle = new Muscle();
        }

        $muscle->fill($this->getFieldValues());

        return $muscle;
    }

    protected function setNameField()
    {
        $this->add('name', 'text', [
            'rules' => [
                'required',
                'string',
                Rule::unique('muscles')//->ignoreModel($this->getModel())
            ]
        ]);
    }
}