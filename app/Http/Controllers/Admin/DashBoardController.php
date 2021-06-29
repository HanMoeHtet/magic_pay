<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
