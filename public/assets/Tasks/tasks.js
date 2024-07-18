document.addEventListener("DOMContentLoaded", function () {
    let deletedcomment_clicks = "";

    // SweetAlert setup
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
    });

    // Add double-click event listeners for board names to enable editing
    let baordnames = document.querySelectorAll(".board-type");
    baordnames.forEach((baordname) => {
        baordname.addEventListener("dblclick", (event) => {
            let board_id = event.target.closest(".bigger-box").getAttribute("data-boardid");
            let type = "Board";
            enableEditing(baordname, type, board_id);
        });
    });

    // Add double-click event listeners for task names to enable editing
    let tasknames = document.querySelectorAll(".task_name");
    tasknames.forEach((taskname) => {
        taskname.addEventListener("dblclick", (event) => {
            let task_id = event.target.closest(".task_elements").getAttribute("data-task_id");
            let type = "Task";
            enableEditing(taskname, type, task_id);
        });
    });

    // Fetch and update task name
    async function EditTasknamefetch(text, id) {
        try {
            const response = await fetch("/edittaskname", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({ id: id, name: text }),
            });

            if (response.ok) {
                const data = await response.json();
                return data.success;
            } else {
                console.error("Failed to update task name");
                return false;
            }
        } catch (error) {
            console.error("Error:", error);
            return false;
        }
    }

    // Fetch and update board name
    async function EditBoardfetch(text, id) {
        try {
            const response = await fetch("/editboardname", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({ id: id, name: text }),
            });

            if (response.ok) {
                const data = await response.json();
                return data.success;
            } else {
                console.error("Failed to update board name");
                return false;
            }
        } catch (error) {
            console.error("Error:", error);
            return false;
        }
    }

    // Function to enable editing on double-click
    async function enableEditing(element, type, id) {
        const originalText = element.textContent.trim();
        const input = document.createElement("input");
        input.type = "text";
        input.value = originalText;
        input.className = "form-control";
        input.style.width = "100%";

        element.replaceWith(input);
        input.focus();

        let replaced = false;

        const replaceElement = async () => {
            if (!replaced) {
                replaced = true;
                const newText = input.value.trim();

                if (newText !== "") {
                    let success = false;

                    if (type === "Board") {
                        success = await EditBoardfetch(newText, id);
                    } else if (type === "Task") {
                        success = await EditTasknamefetch(newText, id);
                    }

                    if (success) {
                        element.textContent = newText;
                    }

                    input.replaceWith(element);
                } else {
                    input.replaceWith(element);
                }
            }
        };

        input.addEventListener("blur", replaceElement);
        input.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
                replaceElement();
            }
        });
    }

    // Show alert to add a new task
    function showAddTaskAlert(event) {
        Swal.fire({
            title: "Enter your task name",
            input: "text",
            inputAttributes: {
                autocapitalize: "off",
            },
            showCancelButton: true,
            confirmButtonText: "Add Task",
            showLoaderOnConfirm: false,
            preConfirm: (taskName) => {
                if (!taskName) {
                    Swal.showValidationMessage("Task name cannot be empty");
                }
                return taskName;
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                addTask(result.value, event);
            }
        });
    }

    // Function to add task to the created tasks div
    function addTask(taskName, event) {
        let project_id = document.getElementById("projectname").getAttribute("data-projectid");
        let board_id = event.target.closest(".bigger-box").getAttribute("data-boardid");

        fetch("/savetask", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ name: taskName, project_id: project_id, board_id: board_id }),
        })
            .then((response) => response.json())
            .then((data) => {
                const formGroup = event.target.closest(".form-group");
                const createdTasksDiv = formGroup.querySelector(".created_tasks");

                if (createdTasksDiv) {
                    const taskElement = document.createElement("div");
                    taskElement.classList.add("task_elements", "box-content");
                    taskElement.draggable = true;
                    taskElement.setAttribute("data-task_id", data.task_id);
                    taskElement.innerHTML = `
                        <div class="total_taskelements">
                            <div class="task_pen">
                                <span class="task_name">${taskName}</span>
                                <i class="bi bi-pencil-square pencil"></i>
                            </div>
                            <span class="threedots">⋮</span>
                        </div>
                        <div class="employee_profile"><i class="bi bi-person-circle"></i></div>
                    `;
                    createdTasksDiv.appendChild(taskElement);

                    // Add event listener to the three dots
                    const threeDotsElements = taskElement.querySelectorAll(".threedots");
                    threeDotsElements.forEach((dot) => {
                        dot.addEventListener("click", (event) => {
                            showDeleteTaskAlert(taskElement, event);
                        });
                    });
                } else {
                    console.error("Error: .created_tasks not found.");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    // Function to show SweetAlert for deleting a task
    function showDeleteTaskAlert(taskElement, event) {
        const taskid = event.target.closest(".task_elements").getAttribute("data-task_id");

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                taskElement.remove();
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your task has been deleted.",
                    icon: "success",
                });

                fetch("/deletetask", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                    body: JSON.stringify({ task_id: taskid }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.message === "task deleted successfully") {
                            location.reload();
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your task is safe :)",
                    icon: "error",
                });
            }
        });
    }

    // Event listener for create task button
    const createTaskButtons = document.querySelectorAll(".create_task");
    createTaskButtons.forEach((createTaskButton) => {
        createTaskButton.addEventListener("click", (event) => {
            showAddTaskAlert(event);
        });
    });

    // Event listener for creating a new board
    const createboardbtn = document.getElementById("button-30");
    createboardbtn.addEventListener("click", () => {
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
            },
        });

        if (!newTitle) return;

        let project_id = document.getElementById("projectname").getAttribute("data-projectid");
        fetch("/saveboard", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ type: newTitle, project_id: project_id }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message === "Board saved successfully") {
                    location.reload();
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    // Add event listeners to delete tasks
    let delete_tasks = document.querySelectorAll(".task_elements .threedots");
    delete_tasks.forEach((delete_task) => {
        delete_task.addEventListener("click", (event) => {
            const taskElement = delete_task.closest(".task_elements");
            showDeleteTaskAlert(taskElement, event);
        });
    });

    // Add event listeners to delete boards
    const boardDots = document.querySelectorAll(".board-dots");
    boardDots.forEach((dot) => {
        dot.addEventListener("click", function (event) {
            const board = this.closest(".box-content");
            let board_id = event.target.closest(".bigger-box").getAttribute("data-boardid");
            const createdTasks = board.querySelector(".created_tasks");

            if (createdTasks.children.length === 0) {
                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("/deleteboard", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            },
                            body: JSON.stringify({ id: board_id }),
                        })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.success) {
                                    board.remove();
                                    swalWithBootstrapButtons.fire({
                                        title: "Deleted!",
                                        text: "The board has been deleted.",
                                        icon: "success",
                                    });
                                } else {
                                    console.log(data);
                                }
                                if (data.message === "Board cannot be deleted it has tasks") {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Cannot delete",
                                        text: "The board contains tasks. Please remove all tasks before deleting the board.",
                                    });
                                }
                            })
                            .catch((error) => {
                                console.error("Error:", error);
                            });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            text: "The board is safe :)",
                            icon: "error",
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Cannot delete",
                    text: "The board contains tasks. Please remove all tasks before deleting the board.",
                });
            }
        });
    });

    const editBar = document.querySelector(".edit_bar");
    const closeBtn = document.querySelector(".close-btn");
    const parentChild = document.querySelector(".parent_child");

    // Open task edit bar on clicking pencil icon
    document.addEventListener("click", (event) => {
        if (event.target.classList.contains("bi-pencil-square")) {
            editBar.classList.add("openbar");
            editBar.classList.remove("closebar");

            let taskContainer = event.target.closest(".task_elements");
            let taskNameElement = taskContainer.querySelector(".task_name");
            let task_id = taskContainer.getAttribute("data-task_id");
            let taskName = taskNameElement.textContent;

            parentChild.innerHTML = "";
            const taskNameElementToAppend = document.createElement("div");
            taskNameElementToAppend.textContent = taskName;
            taskNameElementToAppend.classList.add("taskname_bar");
            taskNameElementToAppend.setAttribute("data-task_id", task_id);
            parentChild.appendChild(taskNameElementToAppend);

            fetch("/getdescription/" + task_id, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({}),
            })
                .then((response) => response.json())
                .then((data) => {
                    const descriptionData = document.querySelector(".description-data");
                    descriptionData.innerHTML = "";

                    if (data.task_desc && data.task_desc.description != null) {
                        descriptionData.innerHTML = data.task_desc.description;
                        document.querySelector(".description_click").style.display = "none";
                    } else {
                        document.querySelector(".description_click").style.display = "block";
                    }
                })
                .catch((error) => {
                    console.error(error);
                });

            fetch("/getcomments/" + task_id, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({}),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.comments && Array.isArray(data.comments)) {
                        document.querySelector(".commentContainer").innerHTML = "";
                        data.comments.forEach((comment) => {
                            const commentText = comment.comment;
                            const comment_id = comment.id;

                            const commentDiv = document.createElement("div");
                            commentDiv.classList.add("comment");
                            commentDiv.setAttribute("data-comment_id", comment_id);
                            commentDiv.innerHTML = `
                                <div class="user_pfp">
                                    <i class="bi bi-person-circle"></i>
                                    <span class="user_comment">${commentText}</span>
                                </div>
                                <div style="display: none" class="comment_edit">
                                    <textarea name="comment_user" class="comment_user" cols="60" rows="5"></textarea>
                                    <button class="save_edit">Save Edit</button>
                                    <button class="cancel_edit">Cancel</button>
                                </div>
                                <button class="edit_comment">Edit</button>
                                <button class="delete_comment">Delete</button>
                            `;
                            document.querySelector(".commentContainer").appendChild(commentDiv);
                            deletedcomment_clicks = document.querySelectorAll(".delete_comment");
                            Deletecomment();
                            editComment();
                        });
                    } else {
                        console.log("No comments found");
                    }
                })
                .catch((error) => console.error("Error:", error));
        }
    });

    // Function to handle comment deletion
    function Deletecomment() {
        deletedcomment_clicks.forEach((deletedcomment_click) => {
            deletedcomment_click.addEventListener("click", (event) => {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let comment = event.target.closest(".comment");
                        let comment_id = comment.getAttribute("data-comment_id");

                        fetch("/deltecomment/" + comment_id, {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            },
                            body: JSON.stringify({}),
                        })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.success) {
                                    comment.remove();
                                }
                            });
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your comment has been deleted.",
                            icon: "success",
                        });
                    }
                });
            });
        });
    }

    function editComment() {
        let editbtncomments = document.querySelectorAll('.edit_comment');
        editbtncomments.forEach((editbtncomment) => {
            editbtncomment.addEventListener('click', (event) => {
                let comment = event.target.closest('.comment');
                let comment_id = comment.getAttribute('data-comment_id');
                comment.querySelector(".user_pfp").style.display = "none";
                comment.querySelector(".edit_comment").style.display = "none";
                comment.querySelector(".delete_comment").style.display = "none";
                comment.querySelector(".comment_edit").style.display = "block";
    
                // Initialize TinyMCE if not already initialized
                let commentTextArea = comment.querySelector(".comment_user");
                if (!commentTextArea.classList.contains('tinymce-initialized')) {
                    tinymce.init({
                        selector: ".comment_user",
                        plugins: "code table lists image",
                        toolbar: "undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image",
                        image_title: true,
                        automatic_uploads: true,
                        file_picker_types: "image",
                        file_picker_callback: function (cb, value, meta) {
                            // Your file picker callback function
                        },
                    });
    
                    commentTextArea.classList.add('tinymce-initialized');
                }
    
                // Set content of TinyMCE editor with current comment text
                tinymce.get(commentTextArea.id).setContent(comment.querySelector(".user_comment").innerHTML);
    
                // Event listener for save edit button
                comment.querySelector(".save_edit").addEventListener("click", () => {
                    let editedCommentText = tinymce.get(commentTextArea.id).getContent();
                    if (editedCommentText.trim() == "") {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Can't save an empty comment!",
                        });
                    } else {

                        fetch("/editcomment", {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            },
                            body: JSON.stringify({id:comment_id,comment:editedCommentText}),
                        })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.success) {
                                    comment.querySelector(".user_comment").innerHTML = editedCommentText;
                                    // Hide edit interface, show user comment and edit/delete buttons
                                    comment.querySelector(".user_pfp").style.display = "block";
                                    comment.querySelector(".edit_comment").style.display = "inline";
                                    comment.querySelector(".delete_comment").style.display = "inline";
                                    comment.querySelector(".comment_edit").style.display = "none";
                                }
                            });
                    }
                });
    
                // Event listener for cancel edit button
                comment.querySelector(".cancel_edit").addEventListener("click", () => {
                    // Hide edit interface, show user comment and edit/delete buttons
                    comment.querySelector(".user_pfp").style.display = "block";
                    comment.querySelector(".edit_comment").style.display = "inline";
                    comment.querySelector(".delete_comment").style.display = "inline";
                    comment.querySelector(".comment_edit").style.display = "none";
                });
            });
        });
    }
    








    closeBtn.addEventListener("click", () => {
        editBar.classList.add("closebar");
        editBar.classList.remove("openbar");
    });

    const descriptionClick = document.querySelector(".description_click");
    const descriptionEditor = document.querySelector(".description-editor");
    const descriptionData = document.querySelector(".description-data");
    const saveDescription = document.getElementById("saveDescription");
    const cancelDescription = document.getElementById("cancelDescription");

    let originalDescription = "";

    // Check if there is existing description data
    if (descriptionData.innerHTML.trim()) {
        descriptionClick.style.display = "none";
    }

    descriptionClick.addEventListener("click", () => {
        originalDescription = descriptionData.innerHTML || "";
        descriptionClick.style.display = "none";
        descriptionEditor.style.display = "block";
        descriptionData.style.display = "none";
        tinymce.get("descriptionEditor").setContent(originalDescription);
        tinymce.execCommand("mceFocus", false, "descriptionEditor");
    });

    descriptionData.addEventListener("click", () => {
        if (descriptionData.innerHTML.trim()) {
            originalDescription = descriptionData.innerHTML;
            descriptionClick.style.display = "none";
            descriptionEditor.style.display = "block";
            descriptionData.style.display = "none";
            tinymce.get("descriptionEditor").setContent(originalDescription);
            tinymce.execCommand("mceFocus", false, "descriptionEditor");
        }
    });

    saveDescription.addEventListener("click", () => {
        let task_id = document.querySelector(".taskname_bar").getAttribute("data-task_id");
        const content = tinymce.get("descriptionEditor").getContent().trim();
        console.log(content,'empty')
        if(content=='') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Description cannot be empty!",
            });
            return
        }
        fetch("/savedescription", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ id: task_id, description: content }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    if (content) {
                        descriptionData.innerHTML = content;
                        descriptionEditor.style.display = "none";
                        descriptionClick.style.display = "none";
                        descriptionData.style.display = "block";
                    }
                   
                    else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Description cannot be empty!",
                        });
                    }
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });

    cancelDescription.addEventListener("click", () => {
        descriptionEditor.style.display = "none";
        if (!descriptionData.innerHTML.trim()) {
            descriptionClick.style.display = "inline";
        }
        descriptionData.innerHTML = originalDescription;
        descriptionData.style.display = "block";
    });

    // Initialize TinyMCE
    tinymce.init({
        selector: "#comment, #comment_user",
        plugins: "code table lists image",
        toolbar: "undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image",
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

    // Show the comment box when "Add a comment" is clicked
    let commentClick = document.querySelector(".comment_click");
    let tinyComment = document.querySelector(".tiny_comment");
    let saveCommentButton = document.querySelector(".save_comment");
    let cancelCommentButton = document.querySelector(".cancel_comment");
    let commentContainer = document.getElementById("commentContainer");

    commentClick.addEventListener("click", () => {
        tinyComment.style.display = "block";
        commentClick.style.display = "none";
    });

    // Save the comment and append it to the container
    saveCommentButton.addEventListener("click", () => {
        let commentText = tinymce.get("comment").getContent();
        let task_id = document.querySelector(".taskname_bar").getAttribute("data-task_id");
        if(commentText==''){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Can't save an empty comment!",
            });
            return
        }
        fetch("/savecomment", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ task_id: task_id, comment: commentText }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (commentText.trim() !== "") {
                    let comment = document.createElement("div");
                    comment.setAttribute("data-comment_id", data.comment_id);
                    comment.classList.add("comment");
                    comment.innerHTML = `
                        <div class="user_pfp">
                            <i class="bi bi-person-circle"></i>
                            <span class="user_comment">${commentText}</span>
                        </div>
                        <div style="display: none" class="comment_edit">
                            <textarea name="comment_user" class="comment_user" cols="60" rows="5"></textarea>
                            <button class="save_edit">Save Edit</button>
                            <button class="cancel_edit">Cancel</button>
                        </div>
                        <button class="edit_comment">Edit</button>
                        <button class="delete_comment">Delete</button>
                    `;
                    commentContainer.insertBefore(comment, commentContainer.firstChild);
                    tinymce.get("comment").setContent("");
                    tinyComment.style.display = "none";
                    commentClick.style.display = "inline";
                    deletedcomment_clicks = document.querySelectorAll(".delete_comment");
                    Deletecomment();
                    editComment();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Can't save an empty comment!",
                    });
                }
            })
            .catch((error) => {
                console.error("Error saving comment:", error);
            });
    });

    // Hide the comment box without saving
    cancelCommentButton.addEventListener("click", () => {
        tinyComment.style.display = "none";
        commentClick.style.display = "inline";
    });

    // Initialize TinyMCE for the main comment textarea
    tinymce.init({
        selector: "#descriptionEditor",
        plugins: "code table lists image",
        toolbar: "undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image",
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
});
