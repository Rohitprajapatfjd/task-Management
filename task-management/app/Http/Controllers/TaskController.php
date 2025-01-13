<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function taskForm(){
        return view('task.formTask');
    }

    public function Addtask(TaskRequest $request){
      $credient = $request->validated();
      Task::create([
        'title'=> $request->title,
        'status'=> $request->status,
        'description'=> $request->description,
        'created_by'=> $request->createdby,
      ]);
      return redirect()->route('task.form')->with(['status'=> 'Add Successfully']);
    }

    public function editForm($id){
        $data = Task::where('id',$id)->get();
        return view('task.editTask' ,compact('data'));
    }
    public function editTaskForm($id,TaskRequest $request){
        $credient = $request->validated();
       $user = Task::where('id',$id)->update([
        'title'=> $request->title,
        'status'=> $request->status,
        'description'=> $request->description,
       ]);
            if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->name){
                return redirect()->route('admin.dashboard')->with(['status'=>'Edit Successfully']);
            }else{
                return redirect()->route('dashboard')->with(['status'=>'Edit Successfully']);
            }
      

    }
    public function DeleteTask($id){
        $user = Task::where('id',$id)->delete();
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->name){
            return redirect()->route('admin.dashboard')->with(['status'=>'Delete Successfully']);
        }else{
            return redirect()->route('dashboard')->with(['status'=>'Delete Successfully']);
        }
    }
}
