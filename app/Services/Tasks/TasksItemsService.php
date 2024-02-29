<?php

namespace App\Services\Tasks;

use App\Http\Resources\TaskResource;
use App\Http\Resources\HistoryResource;
use App\Services\Tasks\TasksService;


final class TasksItemsService extends TasksService{

    public function tasks($request){

        $sorted = $request->sorted ?? 'id';
        $created_at = $request->created_at ?? false;
        $status = $request->status ?? false;

        $list = $this->getTasksList($sorted, $created_at, $status);
        $count = $this->getTasksCount();

        return [
                'items' => TaskResource::collection($list),
                'count' => $count
        ];
        
    }

    public function history(int $task_id){

        return HistoryResource::collection($this->getTaskHistory($task_id));

    }

}