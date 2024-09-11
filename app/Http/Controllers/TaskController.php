<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
class TaskController extends Controller
{
    public function store(Project $pro){
             $data=request()->validate(['body'=>'required']);
             $data['project_id']=$pro->id;
             Task::create($data);
             return back();
    }

    public function update(Project $pro,Task $task){
                $task->update(['done'=>request()->has('done')]);
                return back();
    }

    public function destroy(Project $pro,Task $task){
         $task->delete();
         return redirect('/project/'.$pro->id);
    }
}
