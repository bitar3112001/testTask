<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
   public    function TaskView(){
        return view('tasks/task');
    }
}
