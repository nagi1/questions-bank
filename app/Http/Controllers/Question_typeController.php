<?php

namespace App\Http\Controllers;

use App\DataTables\Question_typeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestion_typeRequest;
use App\Http\Requests\UpdateQuestion_typeRequest;
use App\Repositories\Question_typeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Question_typeController extends AppBaseController
{
    /** @var  Question_typeRepository */
    private $questionTypeRepository;

    public function __construct(Question_typeRepository $questionTypeRepo)
    {
        $this->questionTypeRepository = $questionTypeRepo;
    }

    /**
     * Display a listing of the Question_type.
     *
     * @param Question_typeDataTable $questionTypeDataTable
     * @return Response
     */
    public function index(Question_typeDataTable $questionTypeDataTable)
    {
        return $questionTypeDataTable->render('question_types.index');
    }

    /**
     * Show the form for creating a new Question_type.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_types.create');
    }

    /**
     * Store a newly created Question_type in storage.
     *
     * @param CreateQuestion_typeRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestion_typeRequest $request)
    {
        $input = $request->all();

        $questionType = $this->questionTypeRepository->create($input);

        Flash::success('Question Type saved successfully.');

        return redirect(route('questionTypes.index'));
    }

    /**
     * Display the specified Question_type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionType = $this->questionTypeRepository->find($id);

        if (empty($questionType)) {
            Flash::error('Question Type not found');

            return redirect(route('questionTypes.index'));
        }

        return view('question_types.show')->with('questionType', $questionType);
    }

    /**
     * Show the form for editing the specified Question_type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionType = $this->questionTypeRepository->find($id);

        if (empty($questionType)) {
            Flash::error('Question Type not found');

            return redirect(route('questionTypes.index'));
        }

        return view('question_types.edit')->with('questionType', $questionType);
    }

    /**
     * Update the specified Question_type in storage.
     *
     * @param  int              $id
     * @param UpdateQuestion_typeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestion_typeRequest $request)
    {
        $questionType = $this->questionTypeRepository->find($id);

        if (empty($questionType)) {
            Flash::error('Question Type not found');

            return redirect(route('questionTypes.index'));
        }

        $questionType = $this->questionTypeRepository->update($request->all(), $id);

        Flash::success('Question Type updated successfully.');

        return redirect(route('questionTypes.index'));
    }

    /**
     * Remove the specified Question_type from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionType = $this->questionTypeRepository->find($id);

        if (empty($questionType)) {
            Flash::error('Question Type not found');

            return redirect(route('questionTypes.index'));
        }

        $this->questionTypeRepository->delete($id);

        Flash::success('Question Type deleted successfully.');

        return redirect(route('questionTypes.index'));
    }
}
