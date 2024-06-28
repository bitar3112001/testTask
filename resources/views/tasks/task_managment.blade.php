<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('assets/Tasks/tasks.css')}}">
</head>

<body>
    <div class="nav">
        <h1 class="logo">Youbee.ai</h1>
        <ul class="nav-ul">
            <li>Home</li>
            <li>Projects</li>
            <li>Task</li>
        </ul>
    </div>
    <div class="container">
        <div class="sidebar-bareir">
            <div class="sidebar">
                <div class="sidebarheader">
                    <div class="project-head">
                        <h1 class="project-name">Task management</h1>
                        <p class="project-type">software project</p>
                    </div>
                </div>
                <h3 class="planning">Planning</h3>
                <ul class="sidebar-ul">
                    <li><i class="bi bi-calendar2-range"></i>TimeLine</li>
                    <li><i class="bi bi-box-seam-fill"></i>Board</li>
                    <li><i class="bi bi-list-ul"></i>List</li>
                    <li><i class="bi bi-card-checklist"></i>Issues</li>
                    <li><i class="bi bi-plus-lg"></i>Add view</li>
                    <li class="catigory">Development</li>
                    <li class="code"><i class="bi bi-code-slash"></i>Code</li>
                </ul>
                <hr>
                <ul class="bottom-sidebar">
                    <li><i class="bi bi-file-fill"></i>Project Pages</li>
                    <li><i class="bi bi-file-plus"></i>Add shortcut</li>
                    <li><i class="bi bi-gear"></i>Project settings</li>
                </ul>
            </div>
        </div>
        <div id="managment" class="managment">
            <div id="added_columns" class="added_columns">
                <div class="column">
                    <h1>to do</h1>
                    <input type="text" class="input-task" id="input-task">
                    <button class="task_btn" id="task_btn" onclick="CreateTask()">create</button>
                    <div id="created_task" class="created_task"></div>
                    <div id="task-create" class="task-create">
                        <h3>+ create a task</h3>
                    </div>
                </div>
            </div>

            <div class="create-column" id="create-column">
                <input type="text" class="column-input" id="column-input">
                <button class="column_btn" id="column_btn" onclick="createcolumn1()">create</button>
                <h3 >+ create column</h3>
            </div>
        </div>
    </div> <!-- end container -->

    <div id="edit_delete" class="edit_delete close">
        <div class="task_name"></div>
        <div id="toggle">x</div>
        <div class="edit"></div>
    </div>
    <script src="{{asset('assets/Tasks/tasks.js')}}"></script>
</body>

</html>
