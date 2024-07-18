<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tasks;
use App\Models\Board;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\TestView;

class TaskController extends Controller
{
    public function TaskView()
    {
        $projects = Project::where('type', 'project')->where('status', 'pending')->get();//get() method: This method executes the query and returns the results.
        $tasks = Project::where('type', 'task')->get();
        // $allprojects = Project::all();
        return view('tasks/task', compact('projects', 'tasks'));
    }
    public function NewTask(Request $request)
    {
        $params = $request->validate([
            'name'=>['required','min:3'],
            'project_id' => ["required"],
            'description' => ["required", "min:3"],
            'deploy_date' => ["required", "date", "after_or_equal:today"],
            'submit_date' => ["required", "date", "after_or_equal:deploy_date"]
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

    public function AssignmentView()
    {
        $projects = Project::all();
        return view('tasks/assignment', compact('projects'));
    }



    public function NewAssignment(Request $request)
    {
        $params = $request->validate([
            'name' => ["required", "min:3"],
            'type' => ["required", "in:task,project"], // only 2 possible options can be taken 
            'deploy_date' => ["required", "date", "after_or_equal:today"],
            'submit_date' => ["required", "date", "after_or_equal:deploy_date"]
        ]);
    
        // Create the project and store the instance in a variable
        $project = Project::create($params);
    
        // Create a board and associate it with the project
        Board::create([
            'type' => 'Done',
            'project_id' => $project->id
        ]);
    
        return redirect('/admin/assignment')->with('success', 'New project has been created');
    }
    
    public function AssignmentEdit(Request $request, $id)
    {
        $params = $request->validate([
            'name' => ["required", "min:3"],
            'deploy_date' => ["required", 'date', 'after_or_equal:today'],
            'submit_date' => ["required", "date", "after_or_equal:deploy_date"]
        ]);

        $upproject = Project::find($id);//projecttest 1
        $upproject->name = $request->input('name');//projecttest 1 ->name 
        $upproject->deploy_date = $request->input('deploy_date');
        $upproject->submit_date = $request->input('submit_date');
        $upproject->save();
        return redirect('/admin/assignment')->with('succes', 'edited project/task');

    }
    public function EndAssignment(Request $request, $id)
    {

        $project = project::find($id);
        if ($project->status == 'end') {
            return redirect('/admin/assignment')->with('error', 'project/task already end');
        } else {
            $project->status = 'end';
            $project->save();
            return redirect('/admin/assignment')->with('success', 'Task/project ended successfully');
        }
    }

    public function Manage_Task_View($id){
        $tasks=Tasks::all();
        $project = project::find($id);
        $project_name= $project->name;
        $project_id = $id;
        $boards = Board::where('project_id', $id)->get(); 
        return view('tasks.task_managment',compact('project_name','project_id','boards','tasks'));
    }

    public function test(){
       // $tasks=Tasks::all();
        return view('tasks/testtask');
    }

    public function saveBoard(Request $request)
    {
        Log:info('star');

      $params=  $request->validate([
            'type' => 'required|string|max:20',
            'project_id' => 'required|integer'
        ]);
      Board::create($params);
        return response()->json(['message' => 'Board saved successfully'], 200);
    }
    public function saveTask(Request $request)
    {
        Log::info("Received request to save task", ['request_data' => $request->all()]);
    
        $params = $request->validate([
            'project_id' => 'required|integer',
            'name' => 'required|string|max:30',
            'board_id' => 'required|integer',
        ]);
        
        Log::debug('Save Task Request', $params);
    
        // Create the task and capture the created instance
        $task = Tasks::create($params);
    
        // Return the ID of the created task in the response
        return response()->json(['message' => 'Task saved successfully', 'task_id' => $task->id], 200);
    }
    
    public function deleteTask(Request $request)
    {
        $params = $request->validate([
            'task_id' => 'required|integer',
        ]);
    
        $task = Tasks::find($params['task_id']);
        
        if ($task) {
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Task not found.'], 404);
        }
    }

    public function DeleteBoard(Request $request){
        $params = $request->validate([
            'id' => 'required|integer',
        ]);
        $id=$params['id'];
        $task = Tasks::where('board_id', $id)->first();
        if($task){
            return response()->json(['message'=>'Board cannot be deletd it has tasks']);
        }
      $board  = Board::find($params['id']);
        if ($board ) {
            $board ->delete();
            return response()->json(['message' => 'Board deleted successfully.','success'=>true], 200);
        } 
        else {
            return response()->json(['message' => 'Board not found.'], 404);
        }
    

    }


   public  function saveDescription(Request $request){
    $params = $request->validate([
        'id' => 'required|integer',
        'description'=>'required|string|min:1'
    ]);
    
    $description=$params['description'];
    $id=$params['id'];
    $task=Tasks::where('id',$id)->update(['description'=>$description]);
if($task){
    return response()->json(['message' => 'Description saved successfully.','success'=>true], 200); 
}
else {
    return response()->json(['message' => ' not stored in DB .'], 404);
}

   }

   public function getDescription(Request $request, $id)
   {
       $task_desc = Tasks::where('id', $id)->first();
   
       if ($task_desc) {
           return response()->json(['task_desc' => $task_desc], 200);
       } else {
           return response()->json(['message' => 'Task not found in DB.'], 404);
       }
   }
   
   public function saveComment(Request $request)
   {
    $params = $request->validate([
        'task_id' => 'required|integer',
        'comment'=>'required|string|min:1'
    ]);
       $comment  = comment::create($params);    
       
       return response()->json(['message' => 'comment saved successfully','comment_id'=>$comment->id], 200);
   }
   public function getCommnets(Request $request,$id)
   {
    $comments = Comment::where('task_id', $id)->orderBy('created_at', 'desc')->get();
    return response()->json(['comments' => $comments, 'message' => 'Comments retrieved successfully'], 200);
   }

   public function DeleteCommnet(Request $request ,$id){
//     $user=User::Auth();
//  if($user->isAdmin){}
  $comment = Comment::find($id);
//   if($comment->employee_id!=$user){
//     return response()->json(['message' => 'cannot delete comment.'], 200);
//   }
  //  if($user->isAdmin){}
    if ($comment) {
        $comment->delete();
        return response()->json(['message' => 'comment deleted successfully.','success'=>true], 200);
    } 
    else {
        return response()->json(['message' => 'comment not found.'], 404);
    }
}




public function editBoardName(Request $request){
    $params = $request->validate([
        'id' => 'required|integer|min:1',
        'name' => 'required|string|min:1',
    ]);
    $board=Board::find( $params['id']);
    if ($board) {
        Log::info('star');
        $board->update(['type'=>$params['name']]);
        
        return response()->json(['message' => 'Board name updated successfully.','success'=>true], 200);
    } 
    else {
        return response()->json(['message' => 'Board not found.'], 404);
    }
}

public function editTaskName(Request $request){
    $params = $request->validate([
        'id' => 'required|integer|min:1',
        'name' => 'required|string|min:1',
    ]);
    $task=Tasks::find( $params['id']);
    if ($task) {
        Log::info('star');
        $task->update(['name'=>$params['name']]);
        
        return response()->json(['message' => 'Task name updated successfully.','success'=>true], 200);
    } 
    else {
        return response()->json(['message' => 'Task not found.'], 404);
    }
}
public function editComment(Request $request ){
    $params = $request->validate([
        'id' => 'required|integer|min:1',
        'comment' => 'required|string|min:1',
    ]);
    $comment=Comment::find( $params['id']);
    if ($comment) {
        Log::info('star');
        $comment->update(['comment'=>$params['comment']]);
        
        return response()->json(['message' => 'Comment edited successfully.','success'=>true], 200);
    } 
    else {
        return response()->json(['message' => 'Comment not found.'], 404);
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
}