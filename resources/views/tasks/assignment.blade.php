
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.min.css">
        <style>
            body {
                padding: 20px;
            }
            table {
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #dee2e6;
                padding: 10px;
                margin: 10px;
            }
            .modal-header {
                background-color: #007bff;
                color: white;
            }
            .modal-footer .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-secondary {
                background-color: #6c757d;
                border-color: #6c757d;
            }
        </style>
 <x-sidebar>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddProject_TaskModal">
        Add Project/Task
        </button>
    
        <!-- Add Modal -->
        <div class="modal fade" id="AddProject_TaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Project/Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/assignment" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="deploy_date">Deploy Date</label>
                                <input type="date" name="deploy_date" class="form-control" placeholder="Enter deploy date" required>
                            </div>
                            <div class="form-group">
                                <label for="submit_date">Submit Date</label>
                                <input type="date" name="submit_date" class="form-control" placeholder="Enter submit date" required>
                            </div>
                            <div class="form-group">
                                <label>Type</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="project" value="project" required>
                                    <label class="form-check-label" for="project">Project</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="task" value="task" required>
                                    <label class="form-check-label" for="task">Task</label>
                                </div>
                            </div>      
                        </div>
                   
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Project/Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        <h1>Test Edit</h1>
    
        <h1>Test Edit Task</h1>
        <table class="table table-striped table-bordered" id="datatable">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>deploy date</th>
                    <th>type</th>
                    <th>submit date</th>
                    <th>status</th>
                    <th>choose to edit</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->name}}</td>
                        <td>{{$project->deploy_date}}</td>
                        <td>{{$project->type}}</td>
                        <td>{{$project->submit_date}}</td>
                        <td>{{$project->status}}</td>
                        <td>
                            <button type="button" class="btn btn-success edit" data-toggle="modal" data-target="#editModal{{$project->id}}">Edit</button>
                            <button type="button" class="btn btn-danger end" data-toggle="modal" data-target="#endModal{{$project->id}}">END</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$project->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{$project->id}}">Edit Project/Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/admin/assignment/{{$project->id}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="edit_name{{$project->id}}">Name</label>
                                            <input type="text" name="name" id="edit_name{{$project->id}}" class="form-control" placeholder="Change name" value="{{$project->name}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_deploy_date{{$project->id}}">deploy date </label>
                                            <input type="date" name="deploy_date" id="edit_deploy_date{{$project->id}}" class="form-control" placeholder="Change deploy date " value="{{$project->deploy_date}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_submit_date{{$project->id}}">Submit Date</label>
                                            <input type="date" name="submit_date" id="edit_submit_date{{$project->id}}" class="form-control" placeholder="Change submit date" value="{{$project->submit_date}}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- End Modal -->
                    <div class="modal fade" id="endModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="endModalLabel{{$project->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="endModalLabel{{$project->id}}">End Project/Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/admin/assignment/end/{{$project->id}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <h1>Are you sure you want to end this Project/task?</h1>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">End Project/Task?</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7">No projects/tasks created</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- @if (session()->has('success'))
    <p>{{session('success')}}</p>
    @endif --}}
 </x-sidebar>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {
                var table = $('#datatable').DataTable();

                table.on('click', '.edit', function () {
                    var $tr = $(this).closest('tr');
                    if ($tr.hasClass('child')) {
                        $tr = $tr.prev('.parent');
                    }
                    var data = table.row($tr).data();
                    console.log(data);

                    $('#edit_name' + data[0]).val(data[1]);
                    $('#edit_deploy_date' + data[0]).val(data[2]);
                    $('#edit_submit_date' + data[0]).val(data[4]);

                    $('#editform').attr('action', '/admin/assignment/' + data[0]);
                    $('#editModal' + data[0]).modal('show');
                });

                table.on('click', '.end', function () {
                    var $tr = $(this).closest('tr');
                    if ($tr.hasClass('child')) {
                        $tr = $tr.prev('.parent');
                    }
                    var data = table.row($tr).data();
                    console.log(data);

                    $('#endform').attr('action', '/admin/assignment/end/' + data[0]);
                    $('#endModal' + data[0]).modal('show');
                });
            });
        </script>

