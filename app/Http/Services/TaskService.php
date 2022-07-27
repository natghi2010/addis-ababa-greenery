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

    public function updateTask($task, $data)
    {
        $task->update($data);
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();
    }

    public function getTaskSummaryByProject($project_id)
    {
        return \DB::table("tasks")
            ->where("project_id", $project_id)
            ->select("tasks.status", "tasks.title")
            ->groupBy("tasks.status", "tasks.title")
            ->get();
    }
}
