<x-sidebar>
    <div class="col-lg-3 col-xs-12">
        <div class="Project_name">project /Task management</div>
        <div class="d-flex flex-row">
            <div class="box-content card white bigger-box col-lg-12 mr-4">
                <h4 class="box-title">To do 1</h4>
                <span class="board-dots"> ⋮</span>
        
                <div class="card-content">
                    <div class="form-group">
                        <div class="created_tasks"></div>
                        <label id="create_task" class="create_task" for="created_tasks">Create Task+</label>
                    </div>
                </div>
            </div>
            <button class="button-30" role="button">+</button>
        </div>
    </div>
    <div class="confirmation-dialog" id="deleteConfirmation">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete this task?</p>
        <button id="confirmDeleteBtn">Delete</button>
        <button class="cancel" id="cancelDeleteBtn">Cancel</button>
    </div>
    <div class="edit_bar box-content closebar ">
        <div class="close-btn"></div>
        <div class="items">
            <div class="parent_child"></div>
            <div class="description-container">
                <span class="description_click" style="cursor: pointer;">Add a description</span>
                <div class="description-editor">
                    <textarea id="descriptionEditor"></textarea>
                    <button id="saveDescription">Save</button>
                    <button id="cancelDescription">cancel</button>
                </div>
                <div class="description-data"></div>
            </div>
            <div class="comment" style="margin-top:25px">
                <div class="comment" style="margin-top:25px">
                    <span class="comment_click" style="cursor: pointer;">Add a comment</span>
                    <div class="tiny_comment" style="display: none;">
                        <textarea name="comment" id="comment" cols="60" rows="5"></textarea>
                    </div>
                    <button class="save_comment">Add</button>
                    <button class="cancel_comment" style="display: none;">Cancel</button>
                    <div id="commentContainer"></div>
                </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</x-sidebar>
