<?php

namespace App\Http\Controllers;

use App\Http\Forms\Exercise\ExerciseForm;
use App\Models\Exercise;
use App\Repositories\Exercise\ExerciseRepository;
use App\Repositories\Muscle\MuscleRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Response;
use Illuminate\View\View;
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
     * @param MuscleRepository $muscleRepository
     *
     * @return View
     */
    public function create(MuscleRepository $muscleRepository): View
    {
        $form = $this->form(ExerciseForm::class,[
            'method' => 'POST',
            'url' => route('exercise.store'),
            'model' => new Exercise(),
            'data' => [
                'muscles' => $muscleRepository->getAllForSelect()
            ]
        ]);

        return view('create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ExerciseRepository $exerciseRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ExerciseRepository $exerciseRepository)
    {
        /** @var ExerciseForm $form */
        $form = $this->form(ExerciseForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('exercise.create')
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $exerciseRepository->createWithRelations($form->mapExercise());

        return redirect()
            ->route('exercise.index')
            ->with('status-success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise $exercise
     *
     * @return View
     */
    public function show(Exercise $exercise): View
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
     * @param  \App\Models\Exercise $exercise
     * @param MuscleRepository $muscleRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise, MuscleRepository $muscleRepository): Response
    {
        $form = $this->form(ExerciseForm::class,[
            'method' => 'PUT',
            'url' => route('exercise.update', $exercise->id),
            'model' => $exercise,
            'data' => [
                'muscles' => $muscleRepository->getAllForSelect()
            ]
        ]);

        return view('create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Exercise $exercise
     *
     * @param ExerciseRepository $exerciseRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Exercise $exercise, ExerciseRepository $exerciseRepository): Response
    {
        /** @var ExerciseForm $form */
        $form = $this->form(ExerciseForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('exercise.edit', $exercise->id)
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $exercise = $form->mapExercise($exercise);

        $exerciseRepository->updateWithRelations($exercise);

        return redirect()
            ->route('exercise.index')
            ->with('status-success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise $exercise
     *
     * @param ExerciseRepository $exerciseRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise, ExerciseRepository $exerciseRepository): Response
    {
        $exerciseRepository->delete($exercise);

        return redirect()
            ->route('exercise.index')
            ->with('status-success', 'Success');
    }
}
