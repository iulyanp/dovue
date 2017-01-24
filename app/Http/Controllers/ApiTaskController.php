<?php

namespace App\Http\Controllers;


use App\Task;
use Illuminate\Http\Request;

class ApiTaskController extends ApiController
{
    public function getTasks()
    {
        $tasks = Task::latest()->get();

        return $this->transformCollection($tasks->toArray());
    }

    public function saveTask(Request $request)
    {
        $body = $request->get('newTask');
        if ('' == trim($body)) {
            return response()->json(['error' => 'Please enter a new task!'], 200);
        }

        $newTask = [
            'body' => $body
        ];

        Task::create($newTask);

        $task = Task::all()->last();

        return  $this->transform($task->toArray());
    }

    public function editTask(Request $request)
    {
        $editedTask = $request->get('task');

        $task = Task::find($editedTask['id']);
        $task->body = $editedTask['body'];
        $task->completed = (boolean)(filter_var($editedTask['completed'], FILTER_VALIDATE_BOOLEAN));
        $task->updated_at = new \DateTime();
        $task->save();

        return response()->json(['id' => $task->id], 200);
    }

    public function deleteTask($id)
    {
        Task::destroy($id);

        return response()->json(['id' => $id], 200);
    }

    public function deleteCompletedTasks()
    {
        Task::where('completed', '=', 1)->delete();
    }
}