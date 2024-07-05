<style>
    .Project_name {
        margin-bottom: 40px;
    }
.task{
    height: 100px;
}
    .button-30 {
        align-items: center;
        appearance: none;
        background-color: #FCFCFD;
        border-radius: 4px;
        border-width: 0;
        box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        box-sizing: border-box;
        color: #36395A;
        cursor: pointer;
        display: inline-flex;
        font-family: "JetBrains Mono", monospace;
        height: 48px;
        justify-content: center;
        line-height: 1;
        list-style: none;
        overflow: hidden;
        padding-left: 16px;
        padding-right: 16px;
        position: relative;
        text-align: left;
        text-decoration: none;
        transition: box-shadow .15s, transform .15s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        white-space: nowrap;
        will-change: box-shadow, transform;
        font-size: 18px;
    }

    .button-30:focus {
        box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
    }

    .button-30:hover {
        box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        transform: translateY(-2px);
    }

    .button-30:active {
        box-shadow: #D6D6E7 0 3px 7px inset;
        transform: translateY(2px);
    }

    .hidden {
        display: none;
    }

    .task {
        display: flex;
        flex-direction: column;
    }

    .allelements {
        display: flex;
        justify-content: space-between;
        width: 100%;
        font-size: 20px;
    }

    .threedots {
        position: relative;
        cursor: pointer;
        margin-right: 10px;
    }

    .threedots:hover::after {
        content: "Delete";
        position: absolute;
        top: 60%;
        left: calc(100% + 40px); /* Adjusted position to the right */
        transform: translateX(-50%);
        background-color: #fff;
        color: #ff0000;
        font-size: 12px; /* Adjusted font size */
        padding: 4px 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 999;
    }
    /* Custom confirmation dialog */
    .confirmation-dialog {
        position: fixed;
        top: 20%; /* Adjusted to be 30% from the top */
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #ffffff;
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        z-index: 1000;
        display: none;
    }
    .created_tasks{
       min-height: 30px;
       min-width: 50px;
   
    }

    .confirmation-dialog.show {
        display: block;
    }

    .confirmation-dialog h2 {
        color: #ff0000;
        margin-bottom: 10px;
    }

    .confirmation-dialog button {
        background-color: #ff0000;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .confirmation-dialog button:hover {
        background-color: #cc0000;
    }

    .confirmation-dialog button.cancel {
        background-color: #ccc;
        margin-left: 10px;
    }

    .confirmation-dialog button.cancel:hover {
        background-color: #999;
    }

    /* Overlay styles */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        z-index: 999; /* Higher than your content, lower than confirmation dialog */
        display: none; /* Initially hidden */
    }

    .employeeicon {
        display: flex;
        justify-content: flex-end;
        height: 50px; /* You can adjust this height */
        margin-left: 20px;
        font-size: 24px; /* Increase the font size as desired */
        margin-top: 10px;
    }

    .bi-person-circle:hover::after {
        content: "Unassigned";
        position: absolute;
        top: calc(45% + 4px); /* Adjusted top position */
        left: calc(90% + 8px); /* Adjusted left position */
        background-color: #fff;
        color: #gray;
        padding: 2px 6px; /* Adjusted padding */
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 14px; /* Adjusted font size */
        white-space: nowrap; /* Ensures it stays on one line */
        z-index: 999;
    }
    .edit_bar{
        position: fixed;
    z-index: 1000;
    background-color: gray;
    top: 0px;
    left: 0px;
    display: flex;
    flex-direction: column;
    row-gap: 20px;
    }


  


.close-btn {
            width: 40px; /* Diameter of the button */
            height: 40px; /* Diameter of the button */
            border-radius: 50%; /* Make it circular */
            background-color: white; /* White background */
            border: 2px solid gold; /* Golden border */
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Optional: Adds a subtle shadow */
            transition: background-color 0.3s, box-shadow 0.3s; /* Smooth transition */
        }

        .close-btn:hover {
            background-color: #fca311; /* Change background to gold on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Enhance shadow on hover */
        }

        /* Style for the 'X' icon */
        .close-btn::before, .close-btn::after {
            content: '';
            position: absolute;
            width: 60%;
            height: 2px;
            background-color: black; /* Black 'X' icon */
        }

        .close-btn::before {
            transform: rotate(45deg);
        }

        .close-btn::after {
            transform: rotate(-45deg);
        }
        .closebar{
            display: none;
        }
        .openbar{
            display: inline;
        }
        
</style>

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
                <span class="discription_click">Add a description</span>
                <div class="tiny_desc"></div>
                <div class="employee_description"> <textarea name="description" id="description" cols="160" rows="4"></textarea></div>
                <button class="save_description">save</button>
                <button class="cancel_description">cancel</button>
            </div>
            <div class="comment">
                <span class="comment_click">Add a comment</span>
                <div class="tiny_comment"><textarea name="comment" id="comment" cols="160" rows="5"></textarea></div>
                <button class="save_comment">save</button>
                  <button class="cancel_description">cancel</button>
            </div>

        </div>
    </div>
    <div class="overlay" id="overlay"></div> <!-- Overlay div -->

  
</x-sidebar>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to enable editing on double-click
        function enableEditing(element) {
            element.addEventListener('dblclick', function() {
                const originalText = element.textContent.trim();
                const input = document.createElement('input');
                input.type = 'text';
                input.value = originalText;
                input.className = 'form-control';
                input.style.width = '100%';

                element.parentNode.replaceChild(input, element);

                function confirmEdit() {
                    const newText = input.value.trim();
                    if (newText !== '') {
                        element.textContent = newText;
                    }
                    input.parentNode.replaceChild(element, input);
                }

                input.addEventListener('blur', confirmEdit);// confrims the edit if the user clicks anywhere else 
                input.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        confirmEdit();
                    }
                });

                input.focus();//method is used to set focus to a specific HTML element, typically an input field. 
                //When an element is focused, it becomes the active element on the page and is ready to receive user input.
                // ensures that the input field is focused immediately, so the user can start typing 
                //without any additional clicks.

            });
        }

        // Function to handle drag start
        function handleDragStart(event) {
            event.dataTransfer.setData('text/plain', event.target.id);
        }

        // Function to handle drag over
        function handleDragOver(event) {
            event.preventDefault();
        }

        // Function to handle drop
        function handleDrop(event) {
            event.preventDefault();
            const taskId = event.dataTransfer.getData('text/plain');
            const draggedTask = document.getElementById(taskId);
            const targetContainer = event.target.closest('.created_tasks');

            if (targetContainer && draggedTask) {
                targetContainer.appendChild(draggedTask);
            }
        }

        // Attach event listeners to all tasks
        const allTasks = document.querySelectorAll('.task');
        allTasks.forEach(function(task) {
            task.addEventListener('dragstart', handleDragStart);
        });

        // Attach event listeners to all created_tasks containers
        const createdTasksContainers = document.querySelectorAll('.created_tasks');
        createdTasksContainers.forEach(function(container) {
            container.addEventListener('dragover', handleDragOver);
            container.addEventListener('drop', handleDrop);
        });

        // Function to close the confirmation dialog and overlay
        function closeConfirmationDialog() {
            confirmationDialog.classList.remove('show');
            overlay.classList.remove('show');
        }

        // Add editing functionality to all relevant elements
        const editableElements = document.querySelectorAll('.box-title, .task_name');
        editableElements.forEach(enableEditing);

        // Add task creation functionality
        const createTaskLabels = document.querySelectorAll('.create_task');
        const confirmationDialog = document.getElementById('deleteConfirmation');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const overlay = document.getElementById('overlay');

        createTaskLabels.forEach(function(label) {
            label.addEventListener('click', function() {
                var createTaskBtn = document.createElement('button');
                createTaskBtn.classList.add('button'); // Adjusted to select correct button class
                createTaskBtn.innerHTML = 'Create';
                createTaskBtn.disabled = true; // Initially disable the button

                var input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control';
                input.id = 'taskname_input';
                input.placeholder = 'Enter task name';

                var div_task = document.createElement('div');
                div_task.appendChild(input);
                div_task.appendChild(createTaskBtn);

                label.parentNode.replaceChild(div_task, label);

                input.addEventListener('input', function() {
                    const value = input.value.trim();
                    createTaskBtn.disabled = value === '';
                });

                createTaskBtn.addEventListener('click', function() {
                    const inputValue = input.value.trim();
                    if (inputValue !== '') {
                        const allelements = document.createElement('div');
                        allelements.classList.add('allelements');
                        const task_employe = document.createElement('i');
                        task_employe.classList.add('bi', 'bi-person-circle', 'employeeicon');
                        const newTask = document.createElement('div');
                        newTask.classList.add('task', 'box-content');
                        newTask.draggable = true;
                        newTask.id = 'task-' + Math.random().toString(36).substr(2, 9); // Generate unique ID
                        // Task name
                        const taskName = document.createElement('span');
                        taskName.classList.add('task_name');
                        taskName.textContent = inputValue;
                        //allelements.appendChild(taskName);
                        const task_editpen= document.createElement('i');
                        task_editpen.classList.add('bi','bi-pencil-square');
                        const testtaskedit = document.createElement('div');
                        testtaskedit.appendChild(taskName);
                        testtaskedit.appendChild(task_editpen);
                        allelements.appendChild(testtaskedit);
                        task_editpen.addEventListener('click', function() {
                        editBar.classList.toggle('closebar'); // Toggle the class to open/close edit bar
                    });
                       // taskName.appendChild(task_editpen);
                        // Three dots for options
                        const threedot = document.createElement('span');
                        threedot.textContent = ' ⋮';
                        threedot.classList.add('threedots');
                        allelements.appendChild(threedot);
                        newTask.appendChild(allelements);
                        newTask.appendChild(task_employe);

                        // Delete functionality
                        threedot.addEventListener('click', function() {
                            confirmationDialog.classList.add('show');
                            overlay.classList.add('show'); // Show overlay

                            confirmDeleteBtn.addEventListener('click', function() {
                                newTask.remove();
                                closeConfirmationDialog(); // Close confirmation dialog and overlay
                            });

                            cancelDeleteBtn.addEventListener('click', function() {
                                closeConfirmationDialog(); // Close confirmation dialog and overlay
                            });
                        });

                        const createdTasksDiv = document.querySelector('.created_tasks');
                        createdTasksDiv.appendChild(newTask);

                        input.value = '';
                        div_task.parentNode.replaceChild(label, div_task); // Replace div_task with original label

                        // Add editing functionality to the new task
                        enableEditing(taskName);

                        // Attach drag and drop listeners to the new task
                        newTask.addEventListener('dragstart', handleDragStart);
                    }
                });
            });
        });

        // Close confirmation dialog and overlay when clicking outside the dialog
        overlay.addEventListener('click', closeConfirmationDialog);

        // Optionally, you can add a listener to create new cards
        const addButton = document.querySelector('.button-30');
        addButton.addEventListener('click', function() {
            addNewCard();
        });

        // Function to add a new card
        function addNewCard() {
            // Prompt the user to enter the title for the new card
            const newTitle = prompt("Enter the title for the new card:");
            if (!newTitle) {
                // If the user cancels or enters an empty title, return without creating the card
                return;
            }

            const newCard = document.createElement('div');
            newCard.classList.add('box-content', 'card', 'white', 'bigger-box', 'col-lg-12', 'mr-4');
            newCard.innerHTML = `
                <h4 class="box-title">${newTitle}</h4>
                <div class="card-content">
                    <div class="form-group">
                        <div class="created_tasks"></div>
                        <label class="create_task" for="created_tasks">Create Task+</label>
                    </div>
                </div>
            `;
            const flexRow = document.querySelector('.d-flex.flex-row');
            flexRow.insertBefore(newCard, flexRow.querySelector('.button-30'));

            // Add functionality to the new card
            const newTaskLabel = newCard.querySelector('.create_task');
            newTaskLabel.addEventListener('click', function() {
                var createTaskBtn = document.createElement('button');
                createTaskBtn.classList.add('button');
                createTaskBtn.innerHTML = 'Create';
                createTaskBtn.disabled = true;

                var input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control';
                input.id = 'taskname_input';
                input.placeholder = 'Enter task name';

                var div_task = document.createElement('div');
                div_task.appendChild(input);
                div_task.appendChild(createTaskBtn);

                newTaskLabel.parentNode.replaceChild(div_task, newTaskLabel);

                input.addEventListener('input', function() {
                    const value = input.value.trim();
                    createTaskBtn.disabled = value === '';
                });

                createTaskBtn.addEventListener('click', function() {
                    const inputValue = input.value.trim();
                    if (inputValue !== '') {
                        const allelements = document.createElement('div');
                        allelements.classList.add('allelements');
                        const task_employe = document.createElement('i');
                        task_employe.classList.add('bi', 'bi-person-circle', 'employeeicon');
                        const newTask = document.createElement('div');
                        newTask.classList.add('task', 'box-content');
                        newTask.draggable = true;
                        newTask.id = 'task-' + Math.random().toString(36).substr(2, 9); // Generate unique ID
                        // Task name
                        const taskName = document.createElement('span');
                        taskName.classList.add('task_name');
                        taskName.textContent = inputValue;
                      //  allelements.appendChild(taskName);
                        const task_editpen= document.createElement('i');
                        task_editpen.classList.add('bi','bi-pencil-square');
                        const testtaskedit = document.createElement('div');
                        testtaskedit.appendChild(taskName);
                        testtaskedit.appendChild(task_editpen);
                        allelements.appendChild(testtaskedit);
                        task_editpen.addEventListener('click', function() {
                        editBar.classList.toggle('closebar'); // Toggle the class to open/close edit bar
                    });
                        // Three dots for options
                        const threedot = document.createElement('span');
                        threedot.textContent = ' ⋮';
                        threedot.classList.add('threedots');
                        allelements.appendChild(threedot);
                        newTask.appendChild(allelements);
                        newTask.appendChild(task_employe);

                        // Delete functionality
                        threedot.addEventListener('click', function() {
                            confirmationDialog.classList.add('show');
                            overlay.classList.add('show'); // Show overlay

                            confirmDeleteBtn.addEventListener('click', function() {
                                newTask.remove();
                                closeConfirmationDialog(); // Close confirmation dialog and overlay
                            });

                            cancelDeleteBtn.addEventListener('click', function() {
                                closeConfirmationDialog(); // Close confirmation dialog and overlay
                            });
                        });

                        const createdTasksDiv = newCard.querySelector('.created_tasks');
                        createdTasksDiv.appendChild(newTask);

                        input.value = '';
                        div_task.parentNode.replaceChild(newTaskLabel, div_task); // Replace div_task with original label

                        // Add editing functionality to the new task
                        enableEditing(taskName);

                        // Attach drag and drop listeners to the new task
                        newTask.addEventListener('dragstart', handleDragStart);
                    }
                });
            });

            // Attach drag and drop listeners to the new created_tasks container
            const newCreatedTasksContainer = newCard.querySelector('.created_tasks');
            newCreatedTasksContainer.addEventListener('dragover', handleDragOver);
            newCreatedTasksContainer.addEventListener('drop', handleDrop);
        }
        const closeButtons = document.getElementsByClassName('close-btn');
        const editBar = document.getElementsByClassName('edit_bar')[0];

        for (let i = 0; i < closeButtons.length; i++) {
            closeButtons[i].addEventListener('click', () => {
                editBar.classList.add('closebar');
            });
        }
 });
  

</script>
<script>
  tinymce.init({
    selector: "#description, #comment", // Add #comment to the selector
    plugins: "code table lists image",
    toolbar:
        "undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image",
    image_title: true,
    automatic_uploads: true,
    file_picker_types: "image",
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("accept", "image/*");
        input.onchange = function () {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function () {
                var id = "blobid" + new Date().getTime();
                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(",")[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };
        input.click();
    },
});

</script>