<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public    function TaskView(){
       $projects= Project::where('type','project')->where('status','pending')->get();//get() method: This method executes the query and returns the results.
       $tasks= Project::where('type','task')->get();
      // $allprojects = Project::all();
       return view('tasks/task',compact('projects','tasks'));
    }
    public function NewTask(Request $request){
        $params = $request->validate([
            'project_id'=>["required"],
            'description' => ["required", "min:3"],
            'deploy_date' => ["required", "date", "after_or_equal:today"],
            'submit_date' => ["required", "date","after_or_equal:deploy_date"]
        ]);
    
        // if ($request->has('project_id')) {
        //     $params['project_id'] = $request->project_id;
        // } elseif ($request->has('task_id')) {
        //     $params['task_id'] = $request->task_id;
        // }
      
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
        return redirect('/admin/task')->with('success', 'New task has been created');
    }
    
    public function AssignmentView(){
        $projects = Project::all();
        return view('tasks/assignment',compact('projects'));
    }
   


    public function NewAssignment(Request $request){
        $params= $request->validate([
            'name'=>["required","min:3"],
            'type'=> ["required", "in:task,project"],// on.y 2 possible options can be taken 
            'deploy_date'=>["required", "date", "after_or_equal:today"],
            'submit_date'=>["required", "date" ,"after_or_equal:deploy_date"]
        ]);

     Project::create($params);
     return redirect('/admin/assignment')->with('succes','new project has been created');
    }
    public function AssignmentEdit(Request $request,$id){
        $params= $request->validate([
            'name'=>["required","min:3"],
            'deploy_date'=> ["required",'date','after_or_equal:today'],
            'submit_date'=>["required", "date","after_or_equal:deploy_date"]
        ]);
        
        $upproject=Project::find($id);//projecttest 1
        $upproject->name=$request->input('name');//projecttest 1 ->name 
        $upproject->deploy_date=$request->input('deploy_date');
        $upproject->submit_date=$request->input('submit_date');
        $upproject->save();
        return redirect('/admin/assignment')->with('succes','edited project/task');

    }
    public function EndAssignment(Request $request, $id)
{

    $project = project::find($id);
    if($project->status == 'end'){
        return redirect('/admin/assignment')->with('error','project/task already end');
    }
    else{
    $project->status = 'end';
    $project->save();
    return redirect('/admin/assignment')->with('success', 'Task/project ended successfully');
    }
}

}


// not required for further updates 

    // public    function AssignmentView(){
    //     return view('tasks/assignment_task');
    // }


    // public function NewProject(Request $request){
    //     $params= $request->validate([
    //         'name'=>["required","min:3"],
    //         'type'=> ["required", "in:task,project"],// on.y 2 possible options can be taken 
    //         'deploy_date'=>["required", "date", "after_or_equal:today"],
    //         'submit_date'=>["required", "date" ,"after_or_equal:deploy_date"]
    //     ]);

    //  Project::create($params);
    //  return redirect('/admin/assignment')->with('succes','new project has been created');
    // }
