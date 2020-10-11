<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Interfaces\PlanInterface;
class PlanController extends BaseController
{
    protected $planRepository;

    public function __construct(PlanInterface $planRepository){
        $this->planRepository = $planRepository;
    }
    public function index(){
    	$plans = $this->planRepository->listPlans();
    	$this->setPageTitle('Plans', 'List of all plans');
    	return view('admin.plan.index', compact('plans'));
    }
    public function create(){
        $this->setPageTitle('New plan', 'Create new plan');
        return view('admin.plan.create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required|max:191',
            'value'=>'required|numeric',
            'status'=>'required',
            'code'=>'required|unique:plans'
        ]);

        $params = $request->except('_token');
        $plan = $this->planRepository->createPlan($params);
        if (!$plan) {
            return $this->responseRedirectBack('Error occurred while creating plan.', 'error', true, true);
        }
        return $this->responseRedirect('admin.plan.index', 'Plan added successfully' ,'success',false, false);
    }
    public function edit($id){
        $plan = $this->planRepository->findPlanById($id);
        $this->setPageTitle('Plans', 'Edit Plan : '.$plan->name);
        return view('admin.plan.edit', compact('plan'));
    }
    public function update(Request $request){
       $this->validate($request, [
            'name'=>'required|max:191',
            'value'=>'required|numeric',
            'status'=>'required',
            'code'=>'unique:plans,code,'.$request->id
        ]);

        $params = $request->except('_token');

        $plan = $this->planRepository->updatePlan($params);

        if (!$plan) {
            return $this->responseRedirectBack('Error occurred while updating plan.', 'error', true, true);
        }
        return $this->responseRedirectBack('Plan updated successfully' ,'success',false, false);
    }
    public function delete($id){
        $plan = $this->planRepository->deletePlan($id);
        if (!$plan) {
            return $this->responseRedirectBack('Error occurred while deleting plan.', 'error', true, true);
        }
        return $this->responseRedirect('admin.plan.index', 'Plan deleted successfully' ,'success',false, false);
    }
}
