<?php
/**
 * Created by PhpStorm.
 * User: l.kielczewski
 * Date: 2019-04-05
 * Time: 13:07
 */

namespace App\Forms;


use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class MuscleForm extends Form
{
    public function buildForm()
    {
        $this->setNameField();

        $this->add('submit', 'submit');
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