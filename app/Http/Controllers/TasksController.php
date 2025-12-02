<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return response()->json($tasks);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'in:todo,inprogress,done',
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'status' => $validated['status'] ?? 'todo',
        ]);

        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|in:todo,inprogress,done',
        ]);
        

        $task->update($validated);

        return response()->json($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
