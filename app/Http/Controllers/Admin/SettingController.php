<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Controllers\BaseController;
//use App\Models\Setting;
//use App\Traits\UploadAble;
class SettingController //extends BaseController
{
	//use UploadAble;
    public function index()
    {
        $this->setPageTitle('Settings', 'Manage Settings');
        return view('admin.settings.index');
    }
    public function update(Request $request){

    	if ($request->has('site_logo') && ($request->file('site_logo'))) {


    	    if (config('settings.site_logo') != null) {
    	        $this->deleteOne(config('settings.site_logo'));
    	    }
    	    $logo = $this->uploadOne($request->file('site_logo'), 'img');
    	    Setting::set('site_logo', $logo);

    	} elseif ($request->has('site_favicon') && ($request->file('site_favicon'))) {

    	    if (config('settings.site_favicon') != null) {
    	        $this->deleteOne(config('settings.site_favicon'));
    	    }
    	    $favicon = $this->uploadOne($request->file('site_favicon'), 'img');
    	    Setting::set('site_favicon', $favicon);

    	} else {

    	    $keys = $request->except('_token');

    	    foreach ($keys as $key => $value)
    	    {
    	        Setting::set($key, $value);
    	    }
    	}
    	return $this->responseRedirectBack('Settings updated successfully.', 'success');
    }
}
