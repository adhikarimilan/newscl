<?php

namespace App\Http\Controllers\Admin;
use App\Interfaces\CompanyInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
class CompanyController extends BaseController
{
	protected $companyRepository;

	public function __construct(CompanyInterface $companyRepository){
	    $this->companyRepository = $companyRepository;
	}
    public function index(){
    	$companies=$this->companyRepository->listCompanies();
    	$this->setPageTitle('Companies', 'List of all companies');
    	return view('admin.company.index', compact('companies'));
    }
    public function show($id){
        $company=$this->companyRepository->findCompanyById($id);
        $this->setPageTitle('Company Details of '.$company->company_name, 'Company Details');
        return view('admin.company.show', compact('company'));
    }
    public function delete($id){
        $company = $this->companyRepository->deleteCompany($id);
        if (!$company) {
            return $this->responseRedirectBack('Error occurred while deleting company.', 'error', true, true);
        }
        return $this->responseRedirect('admin.company.index', 'company deleted successfully' ,'success',false, false);
    }
}
