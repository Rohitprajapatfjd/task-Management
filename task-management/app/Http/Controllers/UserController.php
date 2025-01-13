<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
        $userId = Auth::user()->id;
        $data = Task::where('created_by',$userId )->get();
        return view('dashboard',compact('data'));
    }
}
