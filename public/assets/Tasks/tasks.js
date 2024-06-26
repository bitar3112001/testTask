// Get references to DOM elements
const taskCreateBtn = document.getElementById("task-create");
const inputTask = document.getElementById("input-task");
const taskBtn = document.getElementById("task_btn");
const createdTaskContainer = document.getElementById("created_task");
const createColumnBtn = document.getElementById("create-column");
const columnInput = document.getElementById("column-input");
const columnBtn = document.getElementById("column_btn");
const addedColumns = document.getElementById("added_columns");

// Show input and button
function showElement(element) {
  element.style.display = "inline";
}

// Hide input and button
function hideElement(element) {
  element.style.display = "none";
}

// Create a new task
function createTask(inputElement, taskContainer) {
  const taskText = inputElement.value.trim();
  if (!taskText) {
    alert("Empty fields");
    return;
  }

  const taskDiv = document.createElement("div");
  taskDiv.className = "taskdiv";
  taskDiv.draggable = true;
  taskDiv.innerHTML = taskText;
  taskContainer.appendChild(taskDiv);

  hideElement(inputElement);
  hideElement(inputElement.nextElementSibling);
  inputElement.value = "";

  addDragEvents(taskDiv);
}

// Add drag events to task
function addDragEvents(taskElement) {
  taskElement.addEventListener("dragstart", (e) => {
    e.dataTransfer.setData("text/plain", taskElement.innerHTML);
    taskElement.classList.add("dragging");
  });

  taskElement.addEventListener("dragend", (e) => {
    taskElement.classList.remove("dragging");
  });
}

// Create a new column
function createColumn() {
  const columnText = columnInput.value.trim();
  if (!columnText) {
    alert("Empty fields");
    return;
  }

  const columnDiv = document.createElement("div");
  columnDiv.className = "column";

  const columnName = document.createElement("h2");
  columnName.innerHTML = columnText;

  const inputTask = document.createElement("input");
  inputTask.type = "text";
  inputTask.className = "input-task";

  const taskButton = document.createElement("button");
  taskButton.className = "task_btn";
  taskButton.innerText = "Create";

  const createdTaskDiv = document.createElement("div");
  createdTaskDiv.className = "created_task";

  const taskCreateDiv = document.createElement("div");
  taskCreateDiv.className = "task-create";
  const taskCreateH3 = document.createElement("h3");
  taskCreateH3.innerText = "+ Create a task";

  taskCreateDiv.appendChild(taskCreateH3);

  columnDiv.append(columnName, inputTask, taskButton, createdTaskDiv, taskCreateDiv);
  addedColumns.appendChild(columnDiv);

  taskCreateH3.addEventListener("click", () => showElement(inputTask));
  taskCreateH3.addEventListener("click", () => showElement(taskButton));
  inputTask.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      createTask(inputTask, createdTaskDiv);
    }
  });

  taskButton.addEventListener("click", () => {
    createTask(inputTask, createdTaskDiv);
  });

  columnInput.value = "";
  hideElement(columnInput);
  hideElement(columnBtn);

  addDropEvents(createdTaskDiv);
}

// Add drop events to created task containers
function addDropEvents(taskContainer) {
  taskContainer.addEventListener("dragover", (e) => e.preventDefault());

  taskContainer.addEventListener("drop", (e) => {
    e.preventDefault();
    const taskText = e.dataTransfer.getData("text/plain");
    const taskDiv = document.createElement("div");
    taskDiv.className = "taskdiv";
    taskDiv.draggable = true;
    taskDiv.innerHTML = taskText;
    taskContainer.appendChild(taskDiv);

    const originalTask = document.querySelector(".dragging");
    if (originalTask) {
      originalTask.remove();
    }

    addDragEvents(taskDiv);
  });
}

// Initialize event listeners
taskCreateBtn.addEventListener("click", () => {
  showElement(inputTask);
  showElement(taskBtn);
});

createColumnBtn.addEventListener("click", () => {
  showElement(columnInput);
  showElement(columnBtn);
});

inputTask.addEventListener("keydown", (event) => {
  if (event.key === "Enter") {
    createTask(inputTask, createdTaskContainer);
  }
});

taskBtn.addEventListener("click", () => {
  createTask(inputTask, createdTaskContainer);
});

columnBtn.addEventListener("click", createColumn);

// Initialize existing columns to accept drops
document.querySelectorAll(".created_task").forEach(addDropEvents);
