<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Task.php

class Task extends Model
{
        public function index()
    {
        // Obtiene todas las tareas
        $tasks = Task::all();

        // Pasa la colección completa a la vista
        return view('tasks.index', compact('tasks'));
    }

}

