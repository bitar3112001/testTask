<x-sidebar>

    <div class="col-lg-3 col-xs-12">
        <div id="projectname" data-projectid="{{ $project_id }}" class="Project_name">Project Name : {{ $project_name }}
        </div>
        <div class="d-flex flex-row created_boards">
            {{-- <div class="box-content card white bigger-box col-lg-12 mr-4">
                <h4 class="box-title">Done</h4>
                <span class="board-dots"> ⋮</span>

                <div class="card-content">
                    <div class="form-group">
                        <div class="created_tasks"></div>
                        <label id="create_task" class="create_task" for="created_tasks">Create Task+</label>
                    </div>
                </div>
            </div> --}}

            @foreach ($boards as $board)
                <div data-boardid="{{ $board->id }}" class="box-content card white bigger-box col-lg-12 mr-4">
                    <div class="box-title board-head">
                        <h4 class="board-title board-type">{{ $board->type }}</h4>
                       @if($isAdmin)
                        <span class="board-dots">⋮</span>
                        @endif
                    </div>
                    <div class="card-content">
                        <div class="form-group">
                            <div class="created_tasks">
                                @foreach ($tasks as $task)
                                    @if ($board->id == $task->board_id)
                                        <div data-task_id="{{ $task->id }}" class="task_elements box-content"

                                            draggable="{{ $isAdmin ? 'true' : 'false' }}">
                                            <div class="total_taskelements">
                                                <div class="task_pen">
                                                    <span class="task_name">{{ $task->name }}</span>
                                                    <i class="bi bi-pencil-square"></i>
                                                </div>
                                                @if($isAdmin)
                                                <span class="threedots">⋮</span>
                                                @endif
                                            </div>
                                            <div class="employee_profile"><i class="bi bi-person-circle pfp"></i></div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                          @if($isAdmin)
                            <label class="create_task" for="created_tasks_{{ $board->id }}">Create Task+</label>
                        @endif
                        </div>
                    </div>
                </div>
            @endforeach


           @if($isAdmin)
            <button id="button-30" class="button-30" role="button">+</button>
            @endif
        </div>
    </div>
    <div class="confirmation-dialog" id="deleteConfirmation">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete this task?</p>
        <button id="confirmDeleteBtn">Delete</button>
        <button class="cancel" id="cancelDeleteBtn">Cancel</button>
    </div>
    <div class="edit_bar box-content closebar">
        <div class="close-btn"></div>
        <div class="items">
            <div class="parent_child"></div>
            <div class="description-container">
                @if($isAdmin)
                <span class="description_click" style="cursor: pointer;">Add a description</span>
                @endif
                <div class="description-editor" style="display: none;">

                    <textarea id="descriptionEditor"></textarea>
                    <button id="saveDescription">Save</button>
                    <button id="cancelDescription">Cancel</button>
                </div>
                <div class="description-data" style="cursor: pointer;"></div>
                <div class="comment" style="margin-top: 25px;">
                    <span class="comment_click" style="cursor: pointer;">Add a comment</span>
                    <div class="tiny_comment" style="display: none;">
                        <textarea name="comment" id="comment" cols="60" rows="5"></textarea>
                        <button class="save_comment">Save</button>
                        <button class="cancel_comment">Cancel</button>
                    </div>
                    <div class="commentContainer" id="commentContainer"></div>
                </div>


            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</x-sidebar>
