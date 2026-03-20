<?php

use App\Http\Controllers\ProfileController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function (Request $request) {
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

        return view('dashboard', [
            'tasks' => $query->get(),
            'filter' => $request->filter ?? 'all',
            'search' => $request->search ?? ''
        ]);
    })->name('dashboard');

    // SIMPAN TUGAS BARU
    Route::post('/tasks', function (Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:low,medium,high',
            'due_at' => 'nullable|date',
            'tags' => 'nullable|string|max:255'
        ]);
        Task::create([
            'title' => $request->title,
            'priority' => $request->priority ?? 'medium',
            'due_at' => $request->due_at,
            'tags' => $request->tags
        ]);
        return back();
    });

    // UPDATE STATUS (Ceklis)
    Route::patch('/tasks/{task}', function (Task $task) {
        $task->update(['is_completed' => !$task->is_completed]);
        return back();
    });

    // UPDATE NAMA TUGAS (Edit)
    Route::put('/tasks/{task}', function (Request $request, Task $task) {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:low,medium,high',
            'due_at' => 'nullable|date',
            'tags' => 'nullable|string|max:255'
        ]);
        $task->update([
            'title' => $request->title,
            'priority' => $request->priority ?? 'medium',
            'due_at' => $request->due_at,
            'tags' => $request->tags
        ]);
        return back();
    });

    // INTELLIGENCE CENTER (Analytics)
    Route::get('/intelligence', function () {
        $total = Task::count();
        $completed = Task::where('is_completed', true)->count();
        
        // Priority Density
        $priorityStats = Task::select('priority', \DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->pluck('total', 'priority')
            ->all();

        // 7-Day Completion Trend
        $trend = Task::where('is_completed', true)
            ->where('updated_at', '>=', now()->subDays(7))
            ->select(\DB::raw('DATE(updated_at) as date'), \DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('intelligence', [
            'totalTasks' => $total,
            'completedCount' => $completed,
            'priorityStats' => $priorityStats,
            'trend' => $trend
        ]);
    })->name('intelligence');

    // TEMPORAL LOG (Audit History)
    Route::get('/log', function () {
        $activities = Task::latest('updated_at')->take(15)->get()->map(function($task) {
            return [
                'type' => $task->wasRecentlyCreated ? 'CREATE' : ($task->is_completed ? 'COMPLETE' : 'UPDATE'),
                'desc' => "Task #{$task->id}: \"{$task->title}\" modified in workspace",
                'time' => $task->updated_at->format('H:i:s'),
                'status' => $task->is_completed ? 'VERIFIED' : 'SYNCED',
                'label' => 'Neural Log'
            ];
        });

        return view('log', ['activities' => $activities]);
    })->name('log');

    // NEXUS WORKSPACE (Team)
    Route::get('/nexus', function () {
        return view('nexus', [
            'activeNodes' => Task::where('is_completed', false)->count(),
            'totalCommits' => Task::count(),
            'efficiency' => Task::count() > 0 ? round((Task::where('is_completed', true)->count() / Task::count()) * 100, 1) : 0
        ]);
    })->name('nexus');

    // HAPUS TUGAS
    Route::delete('/tasks/{task}', function (Task $task) {
        $task->delete();
        return back();
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
