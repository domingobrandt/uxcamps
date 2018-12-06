<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Repositories\JobRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\User;

class JobController extends AppBaseController
{
    /** @var  JobRepository */
    private $jobRepository;

    public function __construct(JobRepository $jobRepo)
    {
        $this->jobRepository = $jobRepo;
    }

    /**
     * Display a listing of the Job.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->jobRepository->pushCriteria(new RequestCriteria($request));
        $jobs = $this->jobRepository->all();

        return view('jobs.index')
            ->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new Job.
     *
     * @return Response
     */
    public function create()
    {
        $users= User::pluck('name','id');

        return view('jobs.create', compact('users'));
    }

    /**
     * Store a newly created Job in storage.
     *
     * @param CreateJobRequest $request
     *
     * @return Response
     */
    public function store(CreateJobRequest $request)
    {
        $input = $request->all();

        $job = $this->jobRepository->create($input);

        Flash::success('Job saved successfully.');

        return redirect(route('jobs.index'));
    }

    /**
     * Display the specified Job.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            Flash::error('Job not found');

            return redirect(route('jobs.index'));
        }

        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified Job.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $users= User::pluck('name','id');

        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            Flash::error('Job not found');

            return redirect(route('jobs.index'));
        }

        return view('jobs.edit', compact('users','job'));
    }

    /**
     * Update the specified Job in storage.
     *
     * @param  int              $id
     * @param UpdateJobRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJobRequest $request)
    {
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            Flash::error('Job not found');

            return redirect(route('jobs.index'));
        }

        $job = $this->jobRepository->update($request->all(), $id);

        Flash::success('Job updated successfully.');

        return redirect(route('jobs.index'));
    }

    /**
     * Remove the specified Job from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            Flash::error('Job not found');

            return redirect(route('jobs.index'));
        }

        $this->jobRepository->delete($id);

        Flash::success('Job deleted successfully.');

        return redirect(route('jobs.index'));
    }
}