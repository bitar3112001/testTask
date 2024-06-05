<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public    function TaskView(){
       $projects= Project::where('type','project')->get();//get() method: This method executes the query and returns the results.
       $tasks= Project::where('type','task')->get();
       return view('tasks/task',['projects'=>$projects],['tasks'=>$tasks]);
    }

    public function NewTask(Request $request){
        $params= $request->validate([
            'project_id'=>["required"],
            'description'=>["required","min:3"],
            'deploy_date'=>["required", "date", "after_or_equal:today"],
            'submit_date'=>["required", "date"]
        ]);

  
     $projectId = $params['project_id'];
         $project = Project::find($projectId);
     // Count the number of tasks already associated with the project
     $taskCount = Tasks::where('project_id', $projectId)->count();
     if ($project->type == 'project') {
        $taskLimit = 4;
    } else {
        $taskLimit = 1;
    }

    // Check if the task count exceeds the limit and set the appropriate error message
    if ($taskCount >= $taskLimit) {
        if ($project->type == 'project') {
            $errorMessage = 'A project can have a maximum of 4 tasks.';
        } else {
            $errorMessage = 'A task can only have 1 task associated with it.';
        }
        return redirect('/admin/task')->withErrors(['error' => $errorMessage]);
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