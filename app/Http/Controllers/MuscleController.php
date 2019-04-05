<?php

namespace App\Http\Controllers;

use App\Forms\MuscleForm;
use App\Logic\Muscle\MuscleLogic;
use App\Models\Muscle;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class MuscleController extends Controller
{
    use FormBuilderTrait;

    /**
     * @var MuscleLogic
     */
    private $muscleLogic;

    public function __construct(MuscleLogic $muscleLogic)
    {
        $this->muscleLogic = $muscleLogic;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->form(MuscleForm::class);

        if (!$form->isValid()) {
            return redirect()->route('muscle.create')->withErrors($form->getErrors())->withInput();
        }

        $this->muscleLogic->create(new Muscle($form->getFieldValues()));

        return redirect()->route('muscle.index')->with('status-success', 'Success');
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
     * @param  \App\Models\Muscle  $muscle
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Muscle  $muscle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $form = $this->form(MuscleForm::class);

        if (!$form->isValid()) {
            return redirect()->route('muscle.edit', $id)->withErrors($form->getErrors())->withInput();
        }

        $this->muscleLogic->update($id, new Muscle($form->getFieldValues()));

        return redirect()->route('muscle.index')->with('status-success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Muscle  $muscle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Muscle $muscle)
    {
        $muscle->delete();

        return redirect()->route('muscle.index')->with('status-success', 'Success');
    }
}
