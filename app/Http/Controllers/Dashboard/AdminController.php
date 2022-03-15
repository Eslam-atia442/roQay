<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\General\MultiDelete;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminController extends GeneralController
{
    protected $viewPath = 'admin.';
    protected $path = 'admins';
    private $route = 'admins';

    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }


    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.index');
    }


    private function roles()
    {
        return Role::get();
    }


    /**
     * View Page Add New Data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // Get Roles
        $roles = $this->roles();
        return view($this->viewPath($this->viewPath . 'create'), compact('roles'));
    }

    public function store(AdminRequest $request)
    {

        // Get data from request
        $inputs = $request->validated();
        // Store Data in DB
        DB::beginTransaction();
        $admin = $this->model->create($inputs);
        // Assign Roles
        $admin->assignRole($request->input('role_id'));
        DB::commit();
        return redirect()->route($this->route)->with('success', 'تم الاضافه بنجاح');

    }


    public function edit($id)
    {
        // Get and Check Data
        $data = $this->model->findorfail($id);
        // Get Roles
        $roles = $this->roles();
        return view($this->viewPath($this->viewPath . 'edit'), compact('data', 'roles'));
    }


    public function update(AdminRequest $request, $id)
    {
        // Get and Check Data
        $data = $this->model->findOrfail($id);
        // Get data from request
        $inputs = $request->validated();
        // Set Password if exist inputs data
        if (!empty($request->input('password'))) {
//            $inputs['password'] = bcrypt($request->input('password'));
        } else {
            unset($inputs['password']);
        }
        DB::beginTransaction();
        $data->update($inputs);
        // Assign Roles
        DB::table('model_has_roles')->where('model_id', $id)->update(['role_id' => $request['role_id']]);
        DB::commit();
        return redirect()->route($this->route)->with('success', 'تم الاضافه بنجاح');

    }


    public function delete($id)
    {
        // Get and Check Data
        $data = $this->model->findOrfail($id);
        // Check If User Delete Yourself
        if (($data->id == '1')) {
            return redirect()->route($this->route)->with('danger', 'لا يمكن حذف مدير الموقع');
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        // Delete Data from DB
        $data->delete();
        return redirect()->route($this->route)->with('success', 'تم الحذف بنجاح');

    }

    public function deletes(MultiDelete $request)
    {
        try {
            // Get Inputs Data From Request
            $data = $request->validated();
            // Get Items Selected
            $items = $this->model->whereIn('id', $data['data']);
            // Check If Not Have Count Items Or Check If User Delete Yourself
            if (!$items->count()) {
                return redirect()->back()->with('danger', 'يجب اختيار عنصر علي الافل');

            }
            if ((in_array(1, $data['data']))) {
                return redirect()->back()->with('danger', 'لا يمكنك حذف الادمن');

            }
            // Get & Delete Data Selected
            $items->delete();
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } catch (\Exception $e) {

            return redirect()->back()->with('danger', 'لا يمكنك الحذف');
        }
    }


}
