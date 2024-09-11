<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=auth()->user()->projects;
        return view('projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.createNewProject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'title'=>'required',
            'description'=>'required'
        ]);
        $data['user_id']=auth()->id();
        Project::create($data);
        return redirect('/project');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $pro= Project::find($id);
        abort_if(auth()->user()->id!== $pro->user->id,403);
        return view('projects.show',compact('pro'));
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        abort_if(auth()->user()->id!== $project->user->id,403);
        $pro=$project;
        return view('projects.edit',compact('pro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data=request()->validate([
            'title'=>'sometimes|required',
            'description'=>'sometimes|required',
            'status'=>'sometimes|required'
        ]);
        $pro=Project::find($id);
        $pro->update($data);
        return redirect('/project/'.$pro->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect('/project');
    }
}
