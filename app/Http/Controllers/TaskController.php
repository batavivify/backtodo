<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\JWTAuth;

class TaskController extends Controller
{

    public function index()
    {

        // token should be proceeded from front-end after login
        $user = JWTAuth::user();

        $tasks = Task::where('user_id', $user->id)->orderBy("priority", "desc")->get();
        return response($tasks, Response::HTTP_OK);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'          => 'required',
            'priority'      => 'required',
            'is_completed'  => 'required',
        ]);

        Task::create([
            'name' => $request['name'],
            'priority' => $request['priority'],
            'is_completed' => $request['is_completed'],
            'user_id' => $request['user_id'],
        ]);

        return response('Task saved to database',Response::HTTP_OK);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return response($task, 200);
    }

    public function delete(Task $task)
    {
        $task->delete();
        return response(null, 204);
    }

}
