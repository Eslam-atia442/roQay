<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\General\MultiDelete;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function redirect;
use function view;

class RoleController extends GeneralController
{
    protected $viewPath = 'role';
    protected $path = 'role';
    private $route = 'roles';
    protected $paginate = 30;
    private $image_path = 'roles';


    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('dashboard.' . $this->viewPath . '.index');
    }

    public function create()
    {
        // Get Permissions
        $permissions = Permission::select('path')->groupBy('path')->get();
        return view('dashboard.' . $this->viewPath . '.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $role_data['slug'] = Str::slug($request->name);
        $role_data['display_name'] = $request->name;
        $role_data['name'] = $request->name;
        $role = Role::create($role_data);
        $role->syncPermissions($request->permissions);
        return redirect()->route($this->route)->with('success', 'تم الاضافه بنجاح');
    }

    public function edit($id)
    {
        // Get and Check Data
        $role = Role::find($id);
        // Get Permissions
        $permissions = Permission::select('path')->groupBy('path')->get();

        // Get Old Assigned Permissions
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('dashboard.' . $this->viewPath . '.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(RoleRequest $request, $id)
    {
        //update role data
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->slug = Str::slug($request->input('name'));
        $role->save();
        //assign new permissions
        $role->syncPermissions($request->input('permissions'));
        return redirect()->route($this->route)->with('success', 'تم التعديل بنجاح');
    }

    public function delete(Request $request, $id)
    {
        $data = $this->model::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
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
                return redirect()->back()->with('danger', 'لا يمكنك حذف مدير النظام');

            }
            // Get & Delete Data Selected
            $items->delete();
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } catch (\Exception $e) {

            return redirect()->back()->with('danger', 'لا يمكنك الحذف');
        }
    }
}
