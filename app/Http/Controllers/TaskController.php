<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public    function TaskView(){
        return view('tasks/task');
    }
    public    function AssignmentView(){
        return view('tasks/assignment_task');
    }


    public function NewProject(Request $request){
        $params= $request->validate([
            'name'=>["required","min:3"],
            'type'=> ["required", "in:task,project"],
            'deploy_date'=>["required", "date", "after_or_equal:today"],
            'submit_date'=>["required", "date"]
        ]);

     Project::create($params);
     return redirect('/admin/assignment')->with('succes','new project has been created');
    }
}
