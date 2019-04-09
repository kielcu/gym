<?php

namespace App\Http\Controllers;

use App\Http\Forms\Work\WorkForm;
use App\Models\Work;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class WorkController extends Controller
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
        $form = $this->form(WorkForm::class, [
            'method' => 'POST',
            'url' => route('work.store'),
            'model' => new Work()
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
        $form = $this->form(WorkForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('work.create')
                ->withErrors($form->getErrors())
                ->withInput();
        }

        Work::query()->create($form->getFieldValues());

        return redirect()
            ->route('work.index')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        $form = $this->form(WorkForm::class, [
            'model' => $work,
            'url' => route('work.update', $work->id),
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
    public function update(Request $request, Work $work)
    {
        $form = $this->form(WorkForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('work.edit', $work->id)
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $work->update($form->getFieldValues());

        return redirect()
            ->route('work.index')
            ->with('status-success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $work->delete();

        return redirect()
            ->route('work.index')
            ->with('status-success', 'Success');
    }
}
