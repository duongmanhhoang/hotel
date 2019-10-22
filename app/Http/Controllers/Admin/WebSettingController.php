<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Settings\UpdateRequest;
use App\Repositories\WebSetting\WebSettingRepository;

class WebSettingController extends Controller
{
	public function __construct(WebSettingRepository $configRepository) {
		$this->configRepository = $configRepository;
	}

    public function edit()
    {
    	$inforWeb = $this->configRepository->all()->first();
    	return view('admin.settings.edit',compact('inforWeb'));
    }

    public function update(UpdateRequest $request, $id)
    {
    	$data = $request->except('_token');
        if ($request->logo && $request->logo_footer) {
            $data['logo'] = uploadImage('logo', $data['logo']);
            $data['logo_footer'] = uploadImage('logo', $data['logo_footer']);
        }
    	else if ($request->logo) {  
    		$data['logo'] = uploadImage('logo', $data['logo']);
    	}
        else if ($request->logo_footer) {
            $data['logo_footer'] = uploadImage('logo', $data['logo_footer']);
        }
    	else { 
    		$data['logo'] = $request->current_image_header;
            $data['logo_footer'] = $request->current_image_footer;
    	}
    	$this->configRepository->update($id, $data);
        $request->session()->flash('success', 'Cập nhật thành công');

        return redirect()->back();
    }
}
