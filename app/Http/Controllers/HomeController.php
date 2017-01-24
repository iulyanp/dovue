<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function showTasks() {
        $tasks = \App\Task::latest()->get();

        return view('homepage', compact('tasks'));
    }
}