<x-sidebar>
    <div class="col-lg-3 col-xs-12">
        <div class="Project_name">project /Task management</div>
        <div class="d-flex flex-row">
            <div class="box-content card white bigger-box col-lg-12 mr-4">
                <h4 class="box-title">To do 1</h4>
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
            <div class="discreption">
                <span class="discription_click" style="cursor: pointer;">Add a description</span>
                <div class="tiny_desc"></div>
                <div class="employee_description">
                    <textarea name="description" id="description" cols="160" rows="4"></textarea>
                </div>
                <button class="save_description">Save</button>
                <button class="cancel_description">Cancel</button>
            </div>
            <div class="comment" style="margin-top:25px">
                <span class="comment_click" style="cursor: pointer;">Add a comment</span>
                <div class="tiny_comment">
                    <textarea name="comment" id="comment" cols="160" rows="5"></textarea>
                </div>
                <div id="commentContainer"></div>

                <button class="save_comment">Save</button>
                <button class="cancel_comment">Cancel</button>
            </div>

        </div>
    </div>
    <div class="overlay" id="overlay"></div> <!-- Overlay div -->


</x-sidebar>
