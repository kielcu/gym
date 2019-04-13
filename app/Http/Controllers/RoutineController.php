<?php

namespace App\Http\Controllers;

use App\Http\Forms\Routine\RoutineForm;
use App\Models\Routine;
use App\Repositories\Routine\RoutineRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class RoutineController extends Controller
{
    use FormBuilderTrait;

    /**
     * @var RoutineRepository
     */
    private $routineRepository;

    public function __construct(RoutineRepository $routineRepository)
    {
        $this->routineRepository = $routineRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Routine::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(RoutineForm::class, [
            'method' => 'POST',
            'url' => route('routine.store'),
            'model' => new Routine()
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
        /** @var RoutineForm $form */
        $form = $this->form(RoutineForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('routine.create')
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $this->routineRepository->create($form->mapRoutine());

        return redirect()
            ->route('routine.index')
            ->with('status-success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Routine::query()->with('exercises')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Routine $routine)
    {
        $form = $this->form(RoutineForm::class, [
            'model' => $routine,
            'url' => route('routine.update', $routine->id),
            'method' => 'PUT'
        ]);

        return view('create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Routine $routine
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Routine $routine)
    {
        /** @var RoutineForm $form */
        $form = $this->form(RoutineForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('routine.edit', $routine->id)
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $this->routineRepository->update($form->mapRoutine($routine));

        return redirect()
            ->route('routine.index')
            ->with('status-success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Routine $routine)
    {
        $this->routineRepository->delete($routine);

        return redirect()
            ->route('routine.index')
            ->with('status-success', 'Success');
    }
}
