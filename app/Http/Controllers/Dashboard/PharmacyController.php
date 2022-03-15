<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\PharmacyDataTable;
use App\DataTables\PharmacyShiftsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\General\MultiDelete;
use App\Http\Requests\PharmacyRequest;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends GeneralController
{
    protected $viewPath = 'pharmacy.';
    protected $path = 'pharmacy';
    private $route = 'pharmacies';
    protected $paginate = 30;
    private $image_path = 'pharmacies';


    public function __construct(Pharmacy $model)
    {
        parent::__construct($model);
    }

    public function index(PharmacyDataTable $dataTable)
    {
        return $dataTable->render('dashboard.' . $this->viewPath . '.index');
    }


    public function indexShifts(PharmacyShiftsDataTable $dataTable,$id)
    {

        return $dataTable->with('key',$id)->render('dashboard.' . $this->viewPath . '.shifts');
    }

    public function create()
    {
        return view('dashboard.' . $this->viewPath . '.create');
    }

    public function store(PharmacyRequest  $request)
    {
        $data = $request->validated();
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

    public function update(PharmacyRequest  $request,$id)
    {
        $data = $request->validated();
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
            // Check If Not Have Count Items Or Check If pharmacy Delete Yourself
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


}
