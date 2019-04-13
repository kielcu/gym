<?php

namespace App\Http\Controllers;

use App\Http\Forms\Work\WorkForm;
use App\Models\Work;
use App\Repositories\Work\WorkRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class WorkController extends Controller
{
    use FormBuilderTrait;


    /**
     * @var WorkRepository
     */
    private $workRepository;

    public function __construct(WorkRepository $workRepository)
    {
        $this->workRepository = $workRepository;
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
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        /** @var WorkForm $form */
        $form = $this->form(WorkForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('work.create')
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $this->workRepository->create($form->mapWork());

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
     * @param Work $work
     *
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
     * @param Work $work
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Work $work)
    {
        /** @var WorkForm $form */
        $form = $this->form(WorkForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->route('work.edit', $work->id)
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $this->workRepository->update($form->mapWork($work));

        return redirect()
            ->route('work.index')
            ->with('status-success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Work $work
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $this->workRepository->delete($work);

        return redirect()
            ->route('work.index')
            ->with('status-success', 'Success');
    }
}
