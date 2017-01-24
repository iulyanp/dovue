<?php

namespace App\Http\Controllers;


class ApiController extends Controller
{

    protected function transformCollection(array $tasks)
    {
        return array_map([$this, 'transform'], $tasks);
    }

    protected function transform($task)
    {
        return [
            'id'         => $task['id'],
            'body'       => $task['body'],
            'completed'  => (boolean)$task['completed'],
            'created_at' => $task['created_at'],
            'updated_at' => $task['updated_at']
        ];
    }

}