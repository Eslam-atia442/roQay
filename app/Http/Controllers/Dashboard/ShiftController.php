<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ShiftDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\General\MultiDelete;
use App\Http\Requests\ShiftRequest;
use App\Models\Pharmacy;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ShiftController extends GeneralController
{
    protected $viewPath = 'shift.';
    protected $path = 'shift';
    private $route = 'shifts';
    protected $paginate = 30;
    private $image_path = 'shifts';


    public function __construct(Shift $model)
    {
        parent::__construct($model);

    }

    public function index(ShiftDataTable $dataTable)
    {
//        return  $this->model::with('User')->get();
        return $dataTable->render('dashboard.' . $this->viewPath . '.index');
    }

    public function create()
    {
         $pharmacy=Pharmacy::select('id','name')->get();
         $user=User::select('id','name')->get();
        return view('dashboard.' . $this->viewPath . '.create',compact('pharmacy','user'));
    }

    public function store(ShiftRequest  $request)
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
        $pharmacy=Pharmacy::select('id','name')->get();
        $user=User::select('id','name')->get();
        $data = $this->model::findOrFail($id);
        return view('dashboard.' . $this->viewPath . '.edit', compact('data','pharmacy','user'));
    }

    public function update(ShiftRequest  $request,$id)
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
            return redirect()->back()->with('danger', 'لا يمكنك الحذف');
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

            return redirect()->back()->with('danger', 'لا يمكنك الحذف');
        }
    }


}
