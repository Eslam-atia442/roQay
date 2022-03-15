<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UserDataTable;
use App\DataTables\UserShiftsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\General\MultiDelete;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends GeneralController
{
    protected $viewPath = 'user.';
    protected $path = 'user';
    private $route = 'users';
    protected $paginate = 30;
    private $image_path = 'users';


    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('dashboard.' . $this->viewPath . '.index');
    }

    public function indexShifts(UserShiftsDataTable $dataTable,$id)
    {
        return $dataTable->with('key',$id)->render('dashboard.' . $this->viewPath . '.shifts');
    }


    public function create()
    {
        return view('dashboard.' . $this->viewPath . '.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        if ($request->image) {
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request->file('image'), $this->image_path, );
            }
        }
        $this->model::create($data);
        return redirect()->route($this->route)->with('success','تم الاضافه بنجاح');
    }
    public function show($id)
    {
        $data = $this->model::findOrFail($id);
        return view('dashboard.' . $this->viewPath . '.details', compact('data'));
    }
    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        return view('dashboard.' . $this->viewPath . '.edit', compact('data'));
    }

    public function update(UserRequest $request,$id)
    {
        $data = $request->validated();
        $item = $this->model->find($id);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), $this->image_path, $item->image);
        }
        $item = $this->model->find($id);
        if ($request->password == null)
        {
            unset($data['password']);
        }
        $item->update($data);
        return redirect()->route($this->route)->with('success','تم التعديل بنجاح');
    }

    public function delete(Request $request, $id)
    {
        try {
            $data = $this->model::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('success','تم الحذف بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'لا يمكنك الحذف لانه مستخدم في دوام');
        }
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
            // Get & Delete Data Selected
            $items->delete();
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } catch (\Exception $e) {

            return redirect()->back()->with('danger', 'لا يمكنك الحذف لانه مستخدم في دوام');
        }
    }

    public function change_status(Request $request)
    {
        $data['status'] = $request->status;
        $user = User::where('id', $request->id)->update($data);
        return 1;
    }

}
