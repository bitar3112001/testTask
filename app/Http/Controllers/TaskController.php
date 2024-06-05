<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public    function TaskView(){
       $projects= Project::all();
        return view('tasks/task',['projects'=>$projects]);
    }

    public function NewTask(Request $request){
        $params= $request->validate([
            'project_id'=>["required"],
            'description'=>["required","min:3"],
            'deploy_date'=>["required", "date", "after_or_equal:today"],
            'submit_date'=>["required", "date"]
        ]);

  
     $projectId = $params['project_id'];

     // Count the number of tasks already associated with the project
     $taskCount = Tasks::where('project_id', $projectId)->count();

     if ($taskCount >= 4) {
        // Redirect back with an error message if the limit is exceeded
        return redirect('/admin/task')->withErrors(['error' => 'A project can have a maximum of 4 tasks.']);
    }
    Tasks::create($params);
     return redirect('/admin/task')->with('succes','new task has been created');
    }

    public    function AssignmentView(){
        return view('tasks/assignment_task');
    }


    public function NewProject(Request $request){
        $params= $request->validate([
            'name'=>["required","min:3"],
            'type'=> ["required", "in:task,project"],// on.y 2 possible options can be taken 
            'deploy_date'=>["required", "date", "after_or_equal:today"],
            'submit_date'=>["required", "date" ,"after_or_equal:today"]
        ]);

     Project::create($params);
     return redirect('/admin/assignment')->with('succes','new project has been created');
    }
}
