<?php

Route::get('api/tasks', ['uses' => 'ApiTaskController@getTasks']);

Route::post('api/task', ['uses' => 'ApiTaskController@saveTask']);

Route::put('api/task/{id}', ['uses' => 'ApiTaskController@editTask']);

Route::delete('api/task/{id}', ['uses' => 'ApiTaskController@deleteTask']);

Route::delete('api/completed-tasks', ['uses' => 'ApiTaskController@deleteCompletedTask']);

Route::get('/', ['uses' => 'HomeController@showTasks']);

