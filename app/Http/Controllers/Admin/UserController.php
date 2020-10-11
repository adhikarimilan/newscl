<?php

namespace App\Http\Controllers\Admin;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
class UserController extends BaseController
{
	protected $userRepository;

	public function __construct(UserInterface $userRepository){
	    $this->userRepository = $userRepository;
	}
    public function index(){
    	$users=$this->userRepository->listUsers();
    	$this->setPageTitle('Users', 'List of all users');
    	return view('admin.user.index', compact('users'));
    }
    public function show($id){
        $user=$this->userRepository->findUserById($id);
        $this->setPageTitle('User Details of '.$user->name, 'User Details');
        return view('admin.user.show', compact('user'));
    }
  	public function delete($id){
  	    $user = $this->userRepository->deleteUser($id);
  	    if (!$user) {
  	        return $this->responseRedirectBack('Error occurred while deleting user.', 'error', true, true);
  	    }
  	    return $this->responseRedirect('admin.user.index', 'user deleted successfully' ,'success',false, false);
  	}
}
