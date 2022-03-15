<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;

class SettingController extends GeneralController
{

    protected $viewPath = 'setting.';
    protected $path = 'setting';
    protected $quality = 100;
    protected $encode = 'png';


    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }


    /**
     * Get All Data Model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->model->get();
        return view($this->viewPath($this->viewPath . 'edit'), compact('data'));
    }


    public function update(SettingRequest $request)
    {
        $data = $this->model->get();
        $inputs = $request->validated();
        if($request->hasFile('logo')) {
            $inputs['logo'] = $this->uploadImage($request->file('logo'), $this->path, $data->where('key', 'logo')->first()->val);
        }
        if($request->hasFile('logo_login')) {
            $inputs['logo_login'] = $this->uploadImage($request->file('logo_login'), $this->path, $data->where('key', 'logo_login')->first()->val);
        }
        if($request->hasFile('login_pg')) {
            $inputs['login_pg'] = $this->uploadImage($request->file('login_pg'), $this->path, $data->where('key', 'login_pg')->first()->val , null,900);
        }
        $this->model->setMany($inputs);
        $this->flash('success','تم التحديث');
        return back();
    }
}
