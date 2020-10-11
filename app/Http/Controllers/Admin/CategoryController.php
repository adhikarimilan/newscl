<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Interfaces\CategoryInterface;
class CategoryController extends BaseController
{
    protected $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }
    public function index(){
    	$categories=$this->categoryRepository->listCategories();
    	$this->setPageTitle('Categories', 'list of all categories');
    	return view('admin.category.index',compact('categories'));
    }
    public function create(){
    	$categories=$this->categoryRepository->listCategories();
    	$this->setPageTitle('Create category','fill all the required form to create new category');
    	return view('admin.category.create',compact('categories'));
    }
    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required|max:191',
            'image'=>'mimes:jpg,jpeg,png|max:1000'
        ]);
        $params=$request->except('_token');
        $category=$this->categoryRepository->createCategory($params);
        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.category.index', 'Category added successfully' ,'success',false, false);
    }
    public function edit($id){
        $targetCategory = $this->categoryRepository->findCategoryById($id);
        $categories = $this->categoryRepository->listCategories();
        $this->setPageTitle('Categories', 'Edit Category : '.$targetCategory->name);
        return view('admin.category.edit', compact('categories', 'targetCategory'));
    }
    public function update(Request $request){
        $this->validate($request, [
            'name'=>'required|max:191',  
            'image'=>'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params=$request->except('_token');
        $category=$this->categoryRepository->updateCategory($params);
        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category updated successfully' ,'success',false, false);
    }
    public function delete($id){
        $category = $this->categoryRepository->deleteCategory($id);
        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.category.index', 'Category deleted successfully' ,'success',false, false);
    }
}
