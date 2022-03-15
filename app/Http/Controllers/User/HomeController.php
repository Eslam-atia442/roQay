<?php

namespace App\Http\Controllers\User;

use App\DataTables\ShiftDataTable;
use App\DataTables\UserhomeShiftsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pharmacy;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function index(UserhomeShiftsDataTable $dataTable)
    {
        $id = auth('user')->user()->id;
        return $dataTable->with('key', $id)->render('user.home');
    }
}
