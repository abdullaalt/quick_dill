<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;

use App\Services\Tasks\TasksItemsService;
use App\Services\Tasks\TasksStoreService;

class TasksController extends Controller
{
    public function tasks(Request $request, TasksItemsService $tasksItemsService){
        return $tasksItemsService->tasks($request);
    }

    public function store(TaskRequest $request, TasksStoreService $tasksStoreService){
        return $tasksStoreService->store($request);
    }

    public function update(int $task_id, TaskUpdateRequest $request, TasksStoreService $tasksStoreService){
        return $tasksStoreService->update($task_id, $request);
    }

    public function delete(int $task_id, TasksStoreService $tasksStoreService){
        return $tasksStoreService->delete($task_id);
    }

    public function history(int $task_id, TasksItemsService $tasksItemsService){
        return $tasksItemsService->history($task_id);
    }
}
