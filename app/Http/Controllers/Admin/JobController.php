<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Interfaces\CategoryInterface;
use App\Interfaces\JobInterface;
use App\Interfaces\PlanInterface;
use App\Models\JobVacancy;
class JobController extends BaseController
{
	protected $categoryRepository;
	protected $jobRepository;
    protected $planRepository;

	public function __construct( CategoryInterface $categoryRepository,JobInterface $jobRepository,PlanInterface $planRepository){
        $this->categoryRepository = $categoryRepository;
        $this->jobRepository=$jobRepository;
        $this->planRepository=$planRepository;
	}
    public function index(){
    	$jobs=$this->jobRepository->listJobs();  
    	$this->setPageTitle('Jobs', 'List of all jobs');
    	return view('admin.jobs.index',compact('jobs'));
    }
    public function show($id){
    	$job=$this->jobRepository->findJobById($id);  
    	$this->setPageTitle('Job Detail', 'Job deatils');
    	return view('admin.jobs.show',compact('job'));    	
    }
    public function edit($id){
        $categories=$this->categoryRepository->listCategories();
        $plans=$this->planRepository->listActivePlans();
        $job=$this->jobRepository->findJobById($id);
        $this->setPageTitle('Edit Job Details of '.$job->job_title, 'Edit Job Details');
        return view('admin.jobs.edit',compact('job','categories','plans'));        
    }
    public function update(Request $request){
        $this->validate($request,[
            'job_title'=>'required|max:250',
            'job_description'=>'required',
            'job_type'=>'required',
            'experience_level'=>'required',
            'no_of_opening'=>'required|numeric',
            'category_id'=>'required|numeric',
            'job_description'=>'required',
            'job_deadline'=>'required|date_format:Y-m-d|after:today',
            "job_location.*"  => "required|string|distinct|min:3",
            'plan_id'=>'required|numeric',
            'job_salary'=>'required',
            'job_education'=>'required',
        ]);
        $params = $request->except('_token','job_location');
        $params['job_locations']=json_encode($request->job_location);

        $job = $this->jobRepository->updateJob($params);

        if (!$job) {
            return $this->responseRedirectBack('Error occurred while updating job.', 'error', true, true);
        }
        return $this->responseRedirectBack('Job updated successfully' ,'success',false, false);

    }
    public function delete($id){
        $job = $this->jobRepository->deleteJob($id);
        if (!$job) {
            return $this->responseRedirectBack('Error occurred while deleting job.', 'error', true, true);
        }
        return $this->responseRedirect('admin.jobs.index', 'Job deleted successfully' ,'success',false, false);
    }
}
