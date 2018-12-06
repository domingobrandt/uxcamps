<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJobAPIRequest;
use App\Http\Requests\API\UpdateJobAPIRequest;
use App\Models\Job;
use App\Repositories\JobRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class JobController
 * @package App\Http\Controllers\API
 */

class JobAPIController extends AppBaseController
{
    /** @var  JobRepository */
    private $jobRepository;

    public function __construct(JobRepository $jobRepo)
    {
        $this->jobRepository = $jobRepo;
    }

    /**
     * Display a listing of the Job.
     * GET|HEAD /jobs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->jobRepository->pushCriteria(new RequestCriteria($request));
        $this->jobRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jobs = $this->jobRepository->all();

        return $this->sendResponse($jobs->toArray(), 'Jobs retrieved successfully');
    }

    /**
     * Store a newly created Job in storage.
     * POST /jobs
     *
     * @param CreateJobAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJobAPIRequest $request)
    {
        $input = $request->all();

        $jobs = $this->jobRepository->create($input);

        return $this->sendResponse($jobs->toArray(), 'Job saved successfully');
    }

    /**
     * Display the specified Job.
     * GET|HEAD /jobs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Job $job */
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            return $this->sendError('Job not found');
        }

        return $this->sendResponse($job->toArray(), 'Job retrieved successfully');
    }

    /**
     * Update the specified Job in storage.
     * PUT/PATCH /jobs/{id}
     *
     * @param  int $id
     * @param UpdateJobAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJobAPIRequest $request)
    {
        $input = $request->all();

        /** @var Job $job */
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            return $this->sendError('Job not found');
        }

        $job = $this->jobRepository->update($input, $id);

        return $this->sendResponse($job->toArray(), 'Job updated successfully');
    }

    /**
     * Remove the specified Job from storage.
     * DELETE /jobs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Job $job */
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            return $this->sendError('Job not found');
        }

        $job->delete();

        return $this->sendResponse($id, 'Job deleted successfully');
    }
}
