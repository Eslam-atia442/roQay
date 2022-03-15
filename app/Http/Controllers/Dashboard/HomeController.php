<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pharmacy;
use App\Models\User;
use Spatie\Permission\Models\Role;
use function view;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['users'] = User::get()->count();
        $data['pharmacies'] = Pharmacy::get()->count();
        $data['admins'] = Admin::get()->count();
        $data['roles'] = Role::get()->count();
        return view('dashboard.home',compact('data'));
    }
}
