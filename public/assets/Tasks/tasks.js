document.addEventListener("DOMContentLoaded", function () {
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

            input.addEventListener("blur", confirmEdit); // confrims the edit if the user clicks anywhere else
            input.addEventListener("keydown", function (event) {
                if (event.key === "Enter") {
                    confirmEdit();
                }
            });

            input.focus(); //method is used to set focus to a specific HTML element, typically an input field.
            //When an element is focused, it becomes the active element on the page and is ready to receive user input.
            // ensures that the input field is focused immediately, so the user can start typing
            //without any additional clicks.
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

    // Function to close the confirmation dialog and overlay
    function closeConfirmationDialog() {
        confirmationDialog.classList.remove("show");
        overlay.classList.remove("show");
    }

    // Add editing functionality to all relevant elements
    const editableElements = document.querySelectorAll(
        ".box-title, .task_name"
    );
    editableElements.forEach(enableEditing);

    // Add task creation functionality
    const createTaskLabels = document.querySelectorAll(".create_task");
    const confirmationDialog = document.getElementById("deleteConfirmation");
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
    const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
    const overlay = document.getElementById("overlay");

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
                    task_employe.classList.add(
                        "bi",
                        "bi-person-circle",
                        "employeeicon"
                    );
                    const newTask = document.createElement("div");
                    newTask.classList.add("task", "box-content");
                    newTask.draggable = true;
                    newTask.id =
                        "task-" + Math.random().toString(36).substr(2, 9); // Generate unique ID
                    // Task name
                    const taskName = document.createElement("span");
                    taskName.classList.add("task_name");
                    taskName.textContent = inputValue;
                    //allelements.appendChild(taskName);
                    const task_editpen = document.createElement("i");
                    task_editpen.classList.add("bi", "bi-pencil-square");
                    const testtaskedit = document.createElement("div");
                    testtaskedit.appendChild(taskName);
                    testtaskedit.appendChild(task_editpen);
                    allelements.appendChild(testtaskedit);
                    task_editpen.addEventListener("click", function () {
                        editBar.classList.toggle("closebar"); // Toggle the class to open/close edit bar
                    });
                    // taskName.appendChild(task_editpen);
                    // Three dots for options
                    const threedot = document.createElement("span");
                    threedot.textContent = " ⋮";
                    threedot.classList.add("threedots");
                    allelements.appendChild(threedot);
                    newTask.appendChild(allelements);
                    newTask.appendChild(task_employe);

                    // Delete functionality
                    threedot.addEventListener("click", function () {
                        confirmationDialog.classList.add("show");
                        overlay.classList.add("show"); // Show overlay

                        confirmDeleteBtn.addEventListener("click", function () {
                            newTask.remove();
                            closeConfirmationDialog(); // Close confirmation dialog and overlay
                        });

                        cancelDeleteBtn.addEventListener("click", function () {
                            closeConfirmationDialog(); // Close confirmation dialog and overlay
                        });
                    });

                    const createdTasksDiv =
                        document.querySelector(".created_tasks");
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

    // Close confirmation dialog and overlay when clicking outside the dialog
    overlay.addEventListener("click", closeConfirmationDialog);

    // Optionally, you can add a listener to create new cards
    const addButton = document.querySelector(".button-30");
    addButton.addEventListener("click", function () {
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

        const newCard = document.createElement("div");
        newCard.classList.add(
            "box-content",
            "card",
            "white",
            "bigger-box",
            "col-lg-12",
            "mr-4"
        );
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
            createTaskBtn.classList.add("button");
            createTaskBtn.innerHTML = "Create";
            createTaskBtn.disabled = true;

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
                    task_employe.classList.add(
                        "bi",
                        "bi-person-circle",
                        "employeeicon"
                    );
                    const newTask = document.createElement("div");
                    newTask.classList.add("task", "box-content");
                    newTask.draggable = true;
                    newTask.id =
                        "task-" + Math.random().toString(36).substr(2, 9); // Generate unique ID
                    // Task name
                    const taskName = document.createElement("span");
                    taskName.classList.add("task_name");
                    taskName.textContent = inputValue;
                    //  allelements.appendChild(taskName);
                    const task_editpen = document.createElement("i");
                    task_editpen.classList.add("bi", "bi-pencil-square");
                    const testtaskedit = document.createElement("div");
                    testtaskedit.appendChild(taskName);
                    testtaskedit.appendChild(task_editpen);
                    allelements.appendChild(testtaskedit);
                    task_editpen.addEventListener("click", function () {
                        editBar.classList.toggle("closebar"); // Toggle the class to open/close edit bar
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
                        confirmationDialog.classList.add("show");
                        overlay.classList.add("show"); // Show overlay

                        confirmDeleteBtn.addEventListener("click", function () {
                            newTask.remove();
                            closeConfirmationDialog(); // Close confirmation dialog and overlay
                        });

                        cancelDeleteBtn.addEventListener("click", function () {
                            closeConfirmationDialog(); // Close confirmation dialog and overlay
                        });
                    });

                    const createdTasksDiv =
                        newCard.querySelector(".created_tasks");
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

        // Attach drag and drop listeners to the new created_tasks container
        const newCreatedTasksContainer =
            newCard.querySelector(".created_tasks");
        newCreatedTasksContainer.addEventListener("dragover", handleDragOver);
        newCreatedTasksContainer.addEventListener("drop", handleDrop);
    }
    const closeButtons = document.getElementsByClassName("close-btn");
    const editBar = document.getElementsByClassName("edit_bar")[0];

    for (let i = 0; i < closeButtons.length; i++) {
        closeButtons[i].addEventListener("click", () => {
            editBar.classList.add("closebar");
        });
    }

    const descClick = document.getElementsByClassName("discription_click");
    const commentClick = document.getElementsByClassName("comment_click");

    const emplDec = document.getElementsByClassName("employee_description");
    const tinyComment = document.getElementsByClassName("tiny_comment");

    const saveDec = document.getElementsByClassName("save_description");
    const saveComment = document.getElementsByClassName("save_comment");

    const cancelComment = document.getElementsByClassName("cancel_comment");
    const cancelDec = document.getElementsByClassName("cancel_description");

    // Convert HTMLCollection to an array for easy iteration
    Array.from(descClick).forEach(function (element) {
        element.addEventListener("click", function () {
            Array.from(emplDec).forEach(function (e) {
                e.style.display = "inline";
            });
            Array.from(saveDec).forEach(function (e) {
                e.style.display = "inline";
            });
            Array.from(cancelDec).forEach(function (e) {
                e.style.display = "inline";
            });
        });
    });
    Array.from(commentClick).forEach(function (element) {
        element.addEventListener("click", function () {
            Array.from(tinyComment).forEach(function (e) {
                e.style.display = "inline";
            });
            Array.from(saveComment).forEach(function (e) {
                e.style.display = "inline";
            });
            Array.from(cancelComment).forEach(function (e) {
                e.style.display = "inline";
            });
        });
    });
    Array.from(cancelDec).forEach(function (element) {
        element.addEventListener("click", function () {
            Array.from(emplDec).forEach(function (e) {
                e.style.display = "none";
            });
            Array.from(saveDec).forEach(function (e) {
                e.style.display = "none";
            });
            Array.from(cancelDec).forEach(function (e) {
                e.style.display = "none";
            });
            emplDec.inputElement.value = "";
        });
    });
    Array.from(cancelComment).forEach(function (element) {
        element.addEventListener("click", function () {
            Array.from(tinyComment).forEach(function (e) {
                e.style.display = "none";
            });
            Array.from(saveComment).forEach(function (e) {
                e.style.display = "none";
            });
            Array.from(cancelComment).forEach(function (e) {
                e.style.display = "none";
            });
            tinyComment.inputElement.value = "";
        });
    });

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
                cb(blobInfo.blobUri(), {
                    title: file.name,
                });
            };
            reader.readAsDataURL(file);
        };
        input.click();
    },
});
