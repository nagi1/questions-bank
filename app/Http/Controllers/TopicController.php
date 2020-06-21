<?php

namespace App\Http\Controllers;

use App\DataTables\TopicDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Repositories\TopicRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TopicController extends AppBaseController
{
    /** @var  TopicRepository */
    private $topicRepository;

    public function __construct(TopicRepository $topicRepo)
    {
        $this->topicRepository = $topicRepo;
    }

    /**
     * Display a listing of the Topic.
     *
     * @param TopicDataTable $topicDataTable
     * @return Response
     */
    public function index(TopicDataTable $topicDataTable)
    {
        return $topicDataTable->render('topics.index');
    }

    /**
     * Show the form for creating a new Topic.
     *
     * @return Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created Topic in storage.
     *
     * @param CreateTopicRequest $request
     *
     * @return Response
     */
    public function store(CreateTopicRequest $request)
    {
        $input = $request->all();

        $topic = $this->topicRepository->create($input);

        Flash::success('Topic saved successfully.');

        return redirect(route('topics.index'));
    }

    /**
     * Display the specified Topic.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $topic = $this->topicRepository->find($id);

        if (empty($topic)) {
            Flash::error('Topic not found');

            return redirect(route('topics.index'));
        }

        return view('topics.show')->with('topic', $topic);
    }

    /**
     * Show the form for editing the specified Topic.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $topic = $this->topicRepository->find($id);

        if (empty($topic)) {
            Flash::error('Topic not found');

            return redirect(route('topics.index'));
        }

        return view('topics.edit')->with('topic', $topic);
    }

    /**
     * Update the specified Topic in storage.
     *
     * @param  int              $id
     * @param UpdateTopicRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTopicRequest $request)
    {
        $topic = $this->topicRepository->find($id);

        if (empty($topic)) {
            Flash::error('Topic not found');

            return redirect(route('topics.index'));
        }

        $topic = $this->topicRepository->update($request->all(), $id);

        Flash::success('Topic updated successfully.');

        return redirect(route('topics.index'));
    }

    /**
     * Remove the specified Topic from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $topic = $this->topicRepository->find($id);

        if (empty($topic)) {
            Flash::error('Topic not found');

            return redirect(route('topics.index'));
        }

        $this->topicRepository->delete($id);

        Flash::success('Topic deleted successfully.');

        return redirect(route('topics.index'));
    }
}
