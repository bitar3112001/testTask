document.addEventListener("DOMContentLoaded", function () {
    // SweetAlert setup
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    // Function to enable editing on double-click
    function enableEditing(element) {
        element.addEventListener("dblclick", function () {
            const originalText = element.textContent.trim();
            const input = document.createElement("input");
            input.type = "text";
            input.value = originalText;
            input.className = "form-control";
            input.style.width = "100%";

            element.parentNode.replaceChild(input, element);

            function confirmEdit() {
                const newText = input.value.trim();
                if (newText !== "") {
                    element.textContent = newText;
                }
                input.parentNode.replaceChild(element, input);
            }

            input.addEventListener("blur", confirmEdit); // confirms the edit if the user clicks anywhere else
            input.addEventListener("keydown", function (event) {
                if (event.key === "Enter") {
                    confirmEdit();
                }
            });

            input.focus(); // ensures that the input field is focused immediately, so the user can start typing without any additional clicks.
        });
    }

    // Function to handle drag start
    function handleDragStart(event) {
        event.dataTransfer.setData("text/plain", event.target.id);
    }

    // Function to handle drag over
    function handleDragOver(event) {
        event.preventDefault();
    }

    // Function to handle drop
    function handleDrop(event) {
        event.preventDefault();
        const taskId = event.dataTransfer.getData("text/plain");
        const draggedTask = document.getElementById(taskId);
        const targetContainer = event.target.closest(".created_tasks");

        if (targetContainer && draggedTask) {
            targetContainer.appendChild(draggedTask);
        }
    }

    // Function to handle drop on bigger-box
    function handleBiggerBoxDrop(event) {
        event.preventDefault();
        const taskId = event.dataTransfer.getData("text/plain");
        const draggedTask = document.getElementById(taskId);
        const targetContainer = event.target.querySelector(".created_tasks");

        if (targetContainer && draggedTask) {
            targetContainer.appendChild(draggedTask);
        }
    }

    // Attach event listeners to all tasks
    const allTasks = document.querySelectorAll(".task");
    allTasks.forEach(function (task) {
        task.addEventListener("dragstart", handleDragStart);
    });

    // Attach event listeners to all created_tasks containers
    const createdTasksContainers = document.querySelectorAll(".created_tasks");
    createdTasksContainers.forEach(function (container) {
        container.addEventListener("dragover", handleDragOver);
        container.addEventListener("drop", handleDrop);
    });

    // Attach event listeners to all bigger-box containers
    const biggerBoxContainers = document.querySelectorAll(".bigger-box");
    biggerBoxContainers.forEach(function (container) {
        container.addEventListener("dragover", handleDragOver);
        container.addEventListener("drop", handleBiggerBoxDrop);
    });

    // Add editing functionality to all relevant elements
    const editableElements = document.querySelectorAll(".box-title, .task_name");
    editableElements.forEach(enableEditing);

    // Add task creation functionality
    const createTaskLabels = document.querySelectorAll(".create_task");

    createTaskLabels.forEach(function (label) {
        label.addEventListener("click", function () {
            var createTaskBtn = document.createElement("button");
            createTaskBtn.classList.add("button"); // Adjusted to select correct button class
            createTaskBtn.innerHTML = "Create";
            createTaskBtn.disabled = true; // Initially disable the button

            var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control";
            input.id = "taskname_input";
            input.placeholder = "Enter task name";

            var div_task = document.createElement("div");
            div_task.appendChild(input);
            div_task.appendChild(createTaskBtn);

            label.parentNode.replaceChild(div_task, label);

            input.addEventListener("input", function () {
                const value = input.value.trim();
                createTaskBtn.disabled = value === "";
            });

            createTaskBtn.addEventListener("click", function () {
                const inputValue = input.value.trim();
                if (inputValue !== "") {
                    const allelements = document.createElement("div");
                    allelements.classList.add("allelements");
                    const task_employe = document.createElement("i");
                    task_employe.classList.add("bi", "bi-person-circle", "employeeicon");
                    const newTask = document.createElement("div");
                    newTask.classList.add("task", "box-content");
                    newTask.draggable = true;
                    newTask.id = "task-" + Math.random().toString(36).substr(2, 9); // Generate unique ID
                    // Task name
                    const taskName = document.createElement("span");
                    taskName.classList.add("task_name");
                    taskName.textContent = inputValue;
                    const task_editpen = document.createElement("i");
                    task_editpen.classList.add("bi", "bi-pencil-square");
                    const testtaskedit = document.createElement("div");
                    testtaskedit.appendChild(taskName);
                    testtaskedit.appendChild(task_editpen);
                    allelements.appendChild(testtaskedit);
                    task_editpen.addEventListener("click", function () {
                        editBar.classList.toggle("closebar"); // Toggle the class to open/close edit bar
                        const parentChildDiv = document.querySelector(".parent_child");
                        parentChildDiv.innerHTML = ""; // Clear previous content
                        const taskNameClone = taskName.cloneNode(true); 
                        const cardTitle = task_editpen.closest(".card").querySelector(".box-title").cloneNode(true);
                        parentChildDiv.appendChild(cardTitle);
                        parentChildDiv.appendChild(taskNameClone);
                    });

                    // Three dots for options
                    const threedot = document.createElement("span");
                    threedot.textContent = " ⋮";
                    threedot.classList.add("threedots");
                    allelements.appendChild(threedot);
                    newTask.appendChild(allelements);
                    newTask.appendChild(task_employe);

                    // Delete functionality
                    threedot.addEventListener("click", function () {
                        swalWithBootstrapButtons.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel!",
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                newTask.remove();
                                swalWithBootstrapButtons.fire({
                                    title: "Deleted!",
                                    text: "Your task has been deleted.",
                                    icon: "success"
                                });
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                swalWithBootstrapButtons.fire({
                                    title: "Cancelled",
                                    text: "Your task is safe :)",
                                    icon: "error"
                                });
                            }
                        });
                    });

                    const createdTasksDiv = document.querySelector(".created_tasks");
                    createdTasksDiv.appendChild(newTask);

                    input.value = "";
                    div_task.parentNode.replaceChild(label, div_task); // Replace div_task with original label

                    // Add editing functionality to the new task
                    enableEditing(taskName);

                    // Attach drag and drop listeners to the new task
                    newTask.addEventListener("dragstart", handleDragStart);
                }
            });
        });
    });

    // Optionally, you can add a listener to create new cards
    const addButton = document.querySelector(".button-30");
    addButton.addEventListener("click", function () {
        addNewCard();
    });

    // Function to add a new card
    async function addNewCard() {
        const { value: newTitle } = await Swal.fire({
            title: "Enter the title for the new card",
            input: "text",
            inputLabel: "Card Title",
            inputPlaceholder: "Enter the title",
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return "You need to write something!";
                }
            }
        });

        if (!newTitle) {
            // If the user cancels or enters an empty title, return without creating the card
            return;
        }

        const newCard = document.createElement("div");
        newCard.classList.add("box-content", "card", "white", "bigger-box", "col-lg-12", "mr-4");
        newCard.innerHTML = `
            <h4 class="box-title">${newTitle}</h4>
            <div class="card-content">
                <div class="form-group">
                    <div class="created_tasks"></div>
                    <label class="create_task" for="created_tasks">Create Task+</label>
                </div>
            </div>
        `;
        const flexRow = document.querySelector(".d-flex.flex-row");
        flexRow.insertBefore(newCard, flexRow.querySelector(".button-30"));

        // Add functionality to the new card
        const newTaskLabel = newCard.querySelector(".create_task");
        newTaskLabel.addEventListener("click", function () {
            var createTaskBtn = document.createElement("button");
            createTaskBtn.classList.add("button"); // Adjusted to select correct button class
            createTaskBtn.innerHTML = "Create";
            createTaskBtn.disabled = true; // Initially disable the button

            var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control";
            input.id = "taskname_input";
            input.placeholder = "Enter task name";

            var div_task = document.createElement("div");
            div_task.appendChild(input);
            div_task.appendChild(createTaskBtn);

            newTaskLabel.parentNode.replaceChild(div_task, newTaskLabel);

            input.addEventListener("input", function () {
                const value = input.value.trim();
                createTaskBtn.disabled = value === "";
            });

            createTaskBtn.addEventListener("click", function () {
                const inputValue = input.value.trim();
                if (inputValue !== "") {
                    const allelements = document.createElement("div");
                    allelements.classList.add("allelements");
                    const task_employe = document.createElement("i");
                    task_employe.classList.add("bi", "bi-person-circle", "employeeicon");
                    const newTask = document.createElement("div");
                    newTask.classList.add("task", "box-content");
                    newTask.draggable = true;
                    newTask.id = "task-" + Math.random().toString(36).substr(2, 9); // Generate unique ID
                    // Task name
                    const taskName = document.createElement("span");
                    taskName.classList.add("task_name");
                    taskName.textContent = inputValue;
                    const task_editpen = document.createElement("i");
                    task_editpen.classList.add("bi", "bi-pencil-square");
                    const testtaskedit = document.createElement("div");
                    testtaskedit.appendChild(taskName);
                    testtaskedit.appendChild(task_editpen);
                    allelements.appendChild(testtaskedit);
                    task_editpen.addEventListener("click", function () {
                        editBar.classList.toggle("closebar"); // Toggle the class to open/close edit bar
                        const parentChildDiv = document.querySelector(".parent_child");
                        parentChildDiv.innerHTML = ""; // Clear previous content
                        const taskNameClone = taskName.cloneNode(true);
                        const cardTitle = task_editpen.closest(".card").querySelector(".box-title").cloneNode(true);
                        parentChildDiv.appendChild(cardTitle);
                        parentChildDiv.appendChild(taskNameClone);
                    });

                    // Three dots for options
                    const threedot = document.createElement("span");
                    threedot.textContent = " ⋮";
                    threedot.classList.add("threedots");
                    allelements.appendChild(threedot);
                    newTask.appendChild(allelements);
                    newTask.appendChild(task_employe);

                    // Delete functionality
                    threedot.addEventListener("click", function () {
                        swalWithBootstrapButtons.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel!",
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                newTask.remove();
                                swalWithBootstrapButtons.fire({
                                    title: "Deleted!",
                                    text: "Your task has been deleted.",
                                    icon: "success"
                                });
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                swalWithBootstrapButtons.fire({
                                    title: "Cancelled",
                                    text: "Your task is safe :)",
                                    icon: "error"
                                });
                            }
                        });
                    });

                    const createdTasksDiv = newCard.querySelector(".created_tasks");
                    createdTasksDiv.appendChild(newTask);

                    input.value = "";
                    div_task.parentNode.replaceChild(newTaskLabel, div_task); // Replace div_task with original label

                    // Add editing functionality to the new task
                    enableEditing(taskName);

                    // Attach drag and drop listeners to the new task
                    newTask.addEventListener("dragstart", handleDragStart);
                }
            });
        });

        // Add drag and drop listeners to the new card's created_tasks div
        const newCreatedTasksDiv = newCard.querySelector(".created_tasks");
        newCreatedTasksDiv.addEventListener("dragover", handleDragOver);
        newCreatedTasksDiv.addEventListener("drop", handleDrop);
        const newbiggerBoxContainers = document.querySelectorAll(".bigger-box");
        newbiggerBoxContainers.forEach(function (container) {
            container.addEventListener("dragover", handleDragOver);
            container.addEventListener("drop", handleBiggerBoxDrop);
        });
        // Add editing functionality to the new card title
        const newCardTitle = newCard.querySelector(".box-title");
        enableEditing(newCardTitle);
    }



    const closeButtons = document.getElementsByClassName("close-btn");
    const editBar = document.getElementsByClassName("edit_bar")[0];

    for (let i = 0; i < closeButtons.length; i++) {
        closeButtons[i].addEventListener("click", () => {
            editBar.classList.add("closebar");
        });
    }


    const descriptionClick = document.querySelector('.description_click');
    const descriptionEditor = document.querySelector('.description-editor');
    const descriptionData = document.querySelector('.description-data');
    const saveButton = document.querySelector('#saveDescription');
    const cancelButton = document.querySelector('#cancelDescription');
    // Show editor when clicking on "Add a description"
    descriptionClick.addEventListener('click', function () {
        descriptionEditor.style.display = 'block';
        descriptionClick.style.display = 'none';
        tinymce.get('descriptionEditor').show();
    });

    // Save the description and hide the editor
    saveButton.addEventListener('click', function () {
        const content = tinymce.get('descriptionEditor').getContent();
        if (content.trim() !== '') {
            descriptionData.innerHTML = content;
            descriptionData.style.display = 'block';
            descriptionClick.style.display = 'none';
        } else {
            descriptionData.style.display = 'none';
            descriptionClick.style.display = 'inline';
        }
        descriptionEditor.style.display = 'none';
        tinymce.get('descriptionEditor').hide();
    });
    cancelButton.addEventListener('click', function () {
        descriptionEditor.style.display = 'none';
        descriptionData.style.display = (descriptionData.innerHTML.trim() !== '') ? 'block' : 'none';
        descriptionClick.style.display = (descriptionData.innerHTML.trim() !== '') ? 'none' : 'inline';
        tinymce.get('descriptionEditor').hide();
    });
    // Enable editing on double-clicking the description
    descriptionData.addEventListener('dblclick', function () {
        tinymce.get('descriptionEditor').setContent(descriptionData.innerHTML);
        descriptionEditor.style.display = 'block';
        descriptionData.style.display = 'none';
        tinymce.get('descriptionEditor').show();
    });

    // Initial state
    if (descriptionData.innerHTML.trim() !== '') {
        descriptionData.style.display = 'block';
        descriptionClick.style.display = 'none';
    } else {
        descriptionData.style.display = 'none';
        descriptionClick.style.display = 'inline';
    }


// comment part 


const commentClick = document.querySelector('.comment_click');
const tinyComment = document.querySelector('.tiny_comment');
const savecommentButton = document.querySelector('.save_comment');
const cancelcommentButton = document.querySelector('.cancel_comment');
const commentContainer = document.querySelector('#commentContainer');
let editingComment = null;

commentClick.addEventListener('click', () => {
    tinyComment.style.display = 'block';
    savecommentButton.style.display = 'inline-block';
    cancelcommentButton.style.display = 'inline-block';
    commentClick.style.display = 'none';
});

cancelcommentButton.addEventListener('click', () => {
    if (editingComment) {
        editingComment.querySelector('.comment_text').style.display = 'block';
        editingComment.querySelector('.edit_tiny_comment').style.display = 'none';
        editingComment.querySelector('.edit_comment').style.display = 'inline-block';
        editingComment.querySelector('.delete_comment').style.display = 'inline-block';
        editingComment = null;
    } else {
        tinyComment.style.display = 'none';
        savecommentButton.style.display = 'none';
        cancelcommentButton.style.display = 'none';
        commentClick.style.display = 'inline-block';
    }
});

savecommentButton.addEventListener('click', () => {
    const commentText = tinymce.get('comment').getContent();
    if (commentText.trim() === "") return; // Do not add empty comments

    const commentDiv = document.createElement('div');
    commentDiv.classList.add('user-comment');
    commentDiv.innerHTML = `
        <i class="bi bi-person-circle"></i>
        <span class="employee_name">eployee name </span>
        <span class="comment_text">${commentText}</span>
        <div class="edit_tiny_comment" style="display: none;">
            <textarea class="edit_comment_tinymce"></textarea>
        </div>
        <button class="edit_comment">Edit</button>
        <button class="delete_comment">Delete</button>
        <button class="save_edit_comment" style="display: none;">Save</button>
        <button class="cancel_edit_comment" style="display: none;">Cancel</button>
    `;
    commentContainer.appendChild(commentDiv);

    tinymce.get('comment').setContent('');
    tinyComment.style.display = 'none';
    savecommentButton.style.display = 'none';
    cancelcommentButton.style.display = 'none';
    commentClick.style.display = 'inline-block';
});

commentContainer.addEventListener('click', (event) => {
    const commentDiv = event.target.closest('.user-comment');
    if (!commentDiv) return;

    if (event.target.classList.contains('edit_comment')) {
        const commentSpan = commentDiv.querySelector('.comment_text');
        const currentContent = commentSpan.innerHTML.trim();
        const editTinyComment = commentDiv.querySelector('.edit_tiny_comment');
        const editTextArea = editTinyComment.querySelector('.edit_comment_tinymce');

        editTinyComment.style.display = 'block';
        commentSpan.style.display = 'none';
        commentDiv.querySelector('.edit_comment').style.display = 'none';
        commentDiv.querySelector('.delete_comment').style.display = 'none';
        commentDiv.querySelector('.save_edit_comment').style.display = 'inline-block';
        commentDiv.querySelector('.cancel_edit_comment').style.display = 'inline-block';

        tinymce.init({
            target: editTextArea,
            plugins: 'autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | charmap',
            menubar: false,
            width: '100%',
            height: 150,
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setContent(currentContent);
                });
                editor.on('blur', function () {
                    if (editingComment) {
                        const updatedContent = editor.getContent();
                        if (updatedContent.trim() !== "") {
                            commentSpan.innerHTML = updatedContent;
                        }
                        commentSpan.style.display = 'block';
                        editTinyComment.style.display = 'none';
                        commentDiv.querySelector('.edit_comment').style.display = 'inline-block';
                        commentDiv.querySelector('.delete_comment').style.display = 'inline-block';
                        commentDiv.querySelector('.save_edit_comment').style.display = 'none';
                        commentDiv.querySelector('.cancel_edit_comment').style.display = 'none';
                        tinymce.remove(editor);
                        editingComment = null;
                    }
                });
            }
        });

        editingComment = commentDiv;
    }

    if (event.target.classList.contains('save_edit_comment')) {
        const editTinyComment = commentDiv.querySelector('.edit_tiny_comment');
        const editTextArea = editTinyComment.querySelector('.edit_comment_tinymce');
        const updatedContent = tinymce.get(editTextArea.id).getContent();
        const commentSpan = commentDiv.querySelector('.comment_text');

        if (updatedContent.trim() === "") return; // Do not save empty comments

        commentSpan.innerHTML = updatedContent;
        commentSpan.style.display = 'block';
        editTinyComment.style.display = 'none';
        commentDiv.querySelector('.edit_comment').style.display = 'inline-block';
        commentDiv.querySelector('.delete_comment').style.display = 'inline-block';
        commentDiv.querySelector('.save_edit_comment').style.display = 'none';
        commentDiv.querySelector('.cancel_edit_comment').style.display = 'none';
        tinymce.remove(editTextArea); // Destroy the editor instance
    }

    if (event.target.classList.contains('cancel_edit_comment')) {
        const editTinyComment = commentDiv.querySelector('.edit_tiny_comment');
        const editTextArea = editTinyComment.querySelector('.edit_comment_tinymce');
        const commentSpan = commentDiv.querySelector('.comment_text');

        commentSpan.style.display = 'block';
        editTinyComment.style.display = 'none';
        commentDiv.querySelector('.edit_comment').style.display = 'inline-block';
        commentDiv.querySelector('.delete_comment').style.display = 'inline-block';
        commentDiv.querySelector('.save_edit_comment').style.display = 'none';
        commentDiv.querySelector('.cancel_edit_comment').style.display = 'none';
        tinymce.remove(editTextArea); // Destroy the editor instance
    }

    if (event.target.classList.contains('delete_comment')) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger" // Corrected from cancelcommentButton to cancelButton
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!", // Corrected from cancelcommentButtonText to cancelButtonText
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                commentDiv.remove();
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your comment has been deleted.",
                    icon: "success"
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your comment is safe :)",
                    icon: "error"
                });
            }
        });
    }
});

document.addEventListener('click', (event) => {
    if (editingComment) {
        const editTinyComment = editingComment.querySelector('.edit_tiny_comment');
        if (!editTinyComment.contains(event.target) && !event.target.classList.contains('edit_comment')) {
            const editTextArea = editTinyComment.querySelector('.edit_comment_tinymce');
            const commentSpan = editingComment.querySelector('.comment_text');
            const updatedContent = tinymce.get(editTextArea.id).getContent();

            if (updatedContent.trim() !== "") {
                commentSpan.innerHTML = updatedContent;
            }
            commentSpan.style.display = 'block';
            editTinyComment.style.display = 'none';
            editingComment.querySelector('.edit_comment').style.display = 'inline-block';
            editingComment.querySelector('.delete_comment').style.display = 'inline-block';
            editingComment.querySelector('.save_edit_comment').style.display = 'none';
            editingComment.querySelector('.cancel_edit_comment').style.display = 'none';
            tinymce.remove(editTextArea); // Destroy the editor instance
            editingComment = null;
        }
    }
});



    // const descClick = document.getElementsByClassName("discription_click");
    // const commentClick = document.getElementsByClassName("comment_click");

    // const emplDec = document.getElementsByClassName("employee_description");
    // const tinyComment = document.getElementsByClassName("tiny_comment");

    // const saveDec = document.getElementsByClassName("save_description");
    // const saveComment = document.getElementsByClassName("save_comment");

    // const cancelComment = document.getElementsByClassName("cancel_comment");
    // const cancelDec = document.getElementsByClassName("cancel_description");




    
    // // Convert HTMLCollection to an array for easy iteration
    // Array.from(descClick).forEach(function (element) {
    //     element.addEventListener("click", function () {
    //         Array.from(emplDec).forEach(function (e) {
    //             e.style.display = "inline";
    //         });
    //         Array.from(saveDec).forEach(function (e) {
    //             e.style.display = "inline";
    //         });
    //         Array.from(cancelDec).forEach(function (e) {
    //             e.style.display = "inline";
    //         });
    //     });
    // });
    // Array.from(commentClick).forEach(function (element) {
    //     element.addEventListener("click", function () {
    //         Array.from(tinyComment).forEach(function (e) {
    //             e.style.display = "inline";
    //         });
    //         Array.from(saveComment).forEach(function (e) {
    //             e.style.display = "inline";
    //         });
    //         Array.from(cancelComment).forEach(function (e) {
    //             e.style.display = "inline";
    //         });
    //     });
    // });
    // Array.from(cancelDec).forEach(function (element) {
    //     element.addEventListener("click", function () {
    //         Array.from(emplDec).forEach(function (e) {
    //             e.style.display = "none";
    //         });
    //         Array.from(saveDec).forEach(function (e) {
    //             e.style.display = "none";
    //         });
    //         Array.from(cancelDec).forEach(function (e) {
    //             e.style.display = "none";
    //         });
    //         emplDec.inputElement.value = "";
    //     });
    // });
    // Array.from(cancelComment).forEach(function (element) {
    //     element.addEventListener("click", function () {
    //         Array.from(tinyComment).forEach(function (e) {
    //             e.style.display = "none";
    //         });
    //         Array.from(saveComment).forEach(function (e) {
    //             e.style.display = "none";
    //         });
    //         Array.from(cancelComment).forEach(function (e) {
    //             e.style.display = "none";
    //         });
    //         tinyComment.inputElement.value = "";
    //     });
    // });

    // document.querySelectorAll(".saveComment").forEach(function (element) {
    //     element.addEventListener("click", function () {
    //         console.log("Save button clicked");
    //         document
    //             .querySelectorAll(".tinyComment")
    //             .forEach(function (inputElement) {
    //                 const commentText = inputElement.value;

    //                 if (commentText.trim() !== "") {
    //                     const newDiv = document.createElement("div");
    //                     newDiv.textContent = commentText;
    //                     document.body.appendChild(newDiv);

    //                     inputElement.value = "";
    //                 }
    //             });
    //     });
    // });
});

tinymce.init({
    selector: "#descriptionEditor, #comment", // Add #comment to the selector
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
                cb(blobInfo.blobUri(), {
                    title: file.name,
                });
            };
            reader.readAsDataURL(file);
        };
        input.click();
    },
});
