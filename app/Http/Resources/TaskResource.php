<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Enums\TasksEnums;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->TasksText->last()->text,
            'is_updated' => count($this->TasksText) > 1,
            'status' => TasksEnums::get($this->status),
            'date' => date('d.m.Y H:i', strtotime($this->created_at)),
            'status_int' => $this->status
        ];
    }
}
