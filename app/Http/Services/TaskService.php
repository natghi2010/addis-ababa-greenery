<?php

namespace App\Http\Services;

use App\Models\Task;

class TaskService
{
    public function getTasks()
    {
        return Task::all();
    }

    public function getTask($id)
    {
        return Task::find($id);
    }

    public function createTask($data)
    {
        return Task::create($data);
    }

    public function updateTask($id, $data)
    {
        Task::find($id)->update($data);
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();
    }

}
