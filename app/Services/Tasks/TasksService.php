<?php

namespace App\Services\Tasks;

use App\Services\MainService;

use App\Models\Task;
use App\Models\TasksText;

abstract class TasksService extends MainService{

    protected function getTasksList(string $sorted = 'id', bool|string $created_at, bool|string $status):object {

        $desciptor = Task::orderBy($sorted, 'desc');

        if ($created_at){
            $desciptor = $desciptor->whereDate('created_at', $created_at);
        }

        if ($status){
            $desciptor = $desciptor->where('status', $status);
        }

        return $desciptor->simplepaginate(30);

    }

    protected function deleteTask(int $task_id):array{
        Task::find($task_id)->delete();
        TasksText::where('task_id', $task_id)->delete();
        return [
            'result' => true
        ];
    }

    protected function getTasksCount(){
        return Task::count();
    }

    protected function saveTask(array $data){

        $task = new Task($data);

        $task->save();

        return $task;

    }

    protected function updateTask(int $task_id, $data){

        $task = Task::find($task_id);

        if ($task){
            $task->fill($data);
            $task->save();
        }

        return $task;

    }

    protected function saveText(array $data){

        $taskText = new TasksText($data);

        $taskText->save();

        return $taskText;

    }

    protected function getTask(int $task_id){

        return Task::find($task_id);

    }

    protected function getTaskHistory($task_id){

        return TasksText::where('task_id', $task_id)->orderBy('id', 'desc')->get();

    }

}