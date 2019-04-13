<?php

namespace App\Http\Controllers;

use App\Http\Forms\Muscle\MuscleForm;
use App\Logic\Muscle\MuscleLogic;
use App\Models\Muscle;
use App\Repositories\MuscleRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class MuscleController extends Controller
{
    use FormBuilderTrait;

    /**
     * @var MuscleRepository
     */
    private $muscleRepository;

    public function __construct(MuscleRepository $muscleRepository)
    {
        $this->muscleRepository = $muscleRepository;
    }

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
        $form = $this->form(MuscleForm::class,[
            'method' => 'POST',
            'url' => route('muscle.store'),
            'model' => new Muscle()
        ]);

        return view('create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        /** @var MuscleForm $form */
        $form = $this->form(MuscleForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('muscle.create')
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $this->muscleRepository->create($form->mapMuscle());

        return redirect()
            ->route('muscle.index')
            ->with('status-success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Muscle  $muscle
     * @return \Illuminate\Http\Response
     */
    public function show(Muscle $muscle)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $muscle = $this->muscleLogic->findById($id);

        $form = $this->form(MuscleForm::class, [
            'model' => $muscle,
            'url' => route('muscle.update', $muscle->id),
            'method' => 'PUT'
        ]);

        return view('create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Muscle $muscle
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Muscle $muscle)
    {
        /** @var MuscleForm $form */
        $form = $this->form(MuscleForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('muscle.edit', $muscle->id)
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $this->muscleRepository->update($form->mapMuscle($muscle));

        return redirect()
            ->route('muscle.index')
            ->with('status-success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Muscle  $muscle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Muscle $muscle)
    {
        $this->muscleRepository->delete($muscle);

        return redirect()
            ->route('muscle.index')
            ->with('status-success', 'Success');
    }
}
