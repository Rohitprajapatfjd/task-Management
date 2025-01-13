<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $due_date = $request->query('due_date');
        $search = $request->query('search');
        $perPage = $request->query('per_page', 2);

        $query = Task::query();
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }
        if ($status) {
            $query->where('status', $status);
        }
      
        if ($due_date) {
            $query->whereDate('due_date', '=', $due_date);
        }

      
        $tasks = $query->paginate($perPage);

        if ($request->ajax()) {
            return response()->json([
                'tasks' => $tasks->items(),
            ]);
        }

        return view('tasks.index', compact('tasks'));
    }
}
