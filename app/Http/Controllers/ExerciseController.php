<?php

namespace App\Http\Controllers;

use App\Http\Forms\Exercise\ExerciseForm;
use App\Models\Exercise;
use App\Models\Muscle;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ExerciseController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(ExerciseForm::class,[
            'method' => 'POST',
            'url' => route('exercise.store'),
            'model' => new Exercise(),
            'data' => [
                'muscles' => Muscle::all()
            ]
        ]);

        return view('create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->form(ExerciseForm::class,['data' => [
            'muscles' => Muscle::all()
        ]]);

        if (!$form->isValid()) {
            return redirect()
                ->route('exercise.create')
                ->withErrors($form->getErrors())
                ->withInput();
        }

        /** @var Exercise $exercise */
        $exercise = Exercise::query()->create($form->getFieldValues());
        $exercise->muscles()->attach($form->getFieldValues()['muscles']);

        return redirect()
            ->route('exercise.index')
            ->with('status-success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
        $exercise->load([
            'muscles' => function(BelongsToMany $query) {
                $query->select('id', 'name');
            }
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        $form = $this->form(ExerciseForm::class,[
            'method' => 'PUT',
            'url' => route('exercise.update', $exercise->id),
            'model' => $exercise,
            'data' => [
                'muscles' => Muscle::all()
            ]
        ]);

        return view('create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Exercise $exercise
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(Exercise $exercise)
    {
        $form = $this->form(ExerciseForm::class,['data' => [
            'muscles' => Muscle::all()
        ]]);

        if (!$form->isValid()) {
            return redirect()
                ->route('exercise.edit', $exercise->id)
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $exercise->update($form->getFieldValues());

        \DB::transaction(function() use($exercise, $form) {
            $exercise->muscles()->detach();
            $exercise->muscles()->attach($form->getFieldValues()['muscles']);
        });

        return redirect()
            ->route('exercise.index')
            ->with('status-success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise $exercise
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()
            ->route('exercise.index')
            ->with('status-success', 'Success');
    }
}
