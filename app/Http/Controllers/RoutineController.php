<?php

namespace App\Http\Controllers;

use App\Http\Forms\Routine\RoutineForm;
use App\Models\Routine;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class RoutineController extends Controller
{
    use FormBuilderTrait;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->form(RoutineForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('routine.create')
                ->withErrors($form->getErrors())
                ->withInput();
        }

        Routine::query()->create($form->getFieldValues());

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Routine $routine)
    {
        $form = $this->form(RoutineForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('routine.edit', $routine->id)
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $routine->update($form->getFieldValues());

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
        $routine->delete();

        return redirect()
            ->route('routine.index')
            ->with('status-success', 'Success');
    }
}
