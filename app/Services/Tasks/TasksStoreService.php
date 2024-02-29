<?php

namespace App\Services\Tasks;

use App\Http\Resources\TaskResource;
use App\Services\Tasks\TasksService;

final class TasksStoreService extends TasksService{

    public function store($request){

        $data = $request->all();
        $data['status'] = 'ACTIVE';
        
        $task = $this->saveTask($data);

        $task_text = $this->saveText(['text' => $data['text'], 'task_id' => $task->id]);

        $task = $this->getTask($task->id);

        return new TaskResource($task);

    }

    public function delete(int $task_id){
        return $this->deleteTask($task_id);
    }

    public function update(int $task_id, $request){

        $data = $request->all();

        if ($request->has('status')){
            $this->updateTask($task_id, $data);
        }

        if ($request->has('text')){
            $this->saveText(['text' => $data['text'], 'task_id' => $task_id]);
        }

        $task = $this->getTask($task_id);

        return new TaskResource($task);

    }

}