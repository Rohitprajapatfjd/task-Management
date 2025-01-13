<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\loginRequest as AdminLoginRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function AdminForm()
    {
        return view('admin.adminLogin');
    }

    public function AdminLogin(AdminLoginRequest $request)
    {
        try {
            $credient = $request->validated();
            if (Auth::guard('admin')->attempt($credient)) {
                return redirect()->route('admin.dashboard')->with(['status' => "Login Successfully"]);
            }
            return redirect()->route('AdminForm')->withErrors(['status' => 'Invalid Email and Password']);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function AdminDashboard()
    {
        $data = Task::paginate(3);
        return view('admin.adminDashboard',compact('data'));
    }

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('AdminForm');
    }
}
