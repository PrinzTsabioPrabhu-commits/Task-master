<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Tampilkan Semua Data
Route::get('/', function (Request $request) {
    $query = Task::orderByRaw("
        CASE priority 
            WHEN 'high' THEN 1 
            WHEN 'medium' THEN 2 
            WHEN 'low' THEN 3 
            ELSE 4 
        END
    ")->latest();

    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->has('filter')) {
        if ($request->filter === 'active') {
            $query->where('is_completed', false);
        } elseif ($request->filter === 'completed') {
            $query->where('is_completed', true);
        }
    }

    return view('welcome', [
        'tasks' => $query->get(),
        'filter' => $request->filter ?? 'all',
        'search' => $request->search ?? ''
    ]);
});

// SIMPAN TUGAS BARU
Route::post('/tasks', function (Request $request) {
    $request->validate([
        'title' => 'required|max:255',
        'priority' => 'required|in:low,medium,high'
    ]);
    Task::create([
        'title' => $request->title,
        'priority' => $request->priority ?? 'medium'
    ]);
    return back();
});

// UPDATE STATUS (Ceklis)
Route::patch('/tasks/{task}', function (Task $task) {
    $task->update(['is_completed' => !$task->is_completed]);
    return back();
});

// UPDATE NAMA TUGAS (Edit) - INI YANG TADI KURANG!
Route::put('/tasks/{task}', function (Request $request, Task $task) {
    $request->validate([
        'title' => 'required|max:255',
        'priority' => 'required|in:low,medium,high'
    ]);
    $task->update([
        'title' => $request->title,
        'priority' => $request->priority ?? 'medium'
    ]);
    return back();
});

// HAPUS TUGAS
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return back();
});