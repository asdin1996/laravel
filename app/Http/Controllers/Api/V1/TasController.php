<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     *
     * Retrieves all tasks from the database and passes them
     * to the `tasks.index` Blade view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created task in the database.
     *
     * Validates input data to ensure 'title' is required and unique.
     * Creates a new Task record and redirects back to the tasks index
     * with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:tasks,title',
            // Add other validation rules if needed
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Task successfully created');
    }
}
