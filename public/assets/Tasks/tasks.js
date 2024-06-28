document.addEventListener('DOMContentLoaded', () => {
  // Get references to DOM elements
  const taskCreateBtn = document.getElementById("task-create");
  const inputTask = document.getElementById("input-task");
  const taskBtn = document.getElementById("task_btn");
  const createdTaskContainer = document.getElementById("created_task");
  const createColumnBtn = document.getElementById("create-column");
  const columnInput = document.getElementById("column-input");
  const columnBtn = document.getElementById("column_btn");
  const addedColumns = document.getElementById("added_columns");
  const editDiv = document.querySelector(".edit");
  const edit_delete= document.getElementById('edit_delete')
  let currentTask = null;
  let input = null;

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

      addDragEvents(taskDiv);// dragable 
      addClickEvent(taskDiv);// clickevent makes the data same in the side bar
  }

  // Add click event to task
 // Add click event to task
function addClickEvent(taskElement) {
  taskElement.addEventListener("click", function () {
      // Clear previous content
      editDiv.innerHTML = '';

      // Create a new <div> element and set its text content
      const p = document.createElement("div");
      p.classList.add('taskdiv');
      p.textContent = taskElement.textContent;
      p.contentEditable = true;  // Make the new div editable

      // Update the original task element when the new div's content changes
      p.addEventListener("input", function () {
          taskElement.textContent = p.textContent;
      });

      // Update the new div's content when the original task element changes
      taskElement.addEventListener("input", function () {
          p.textContent = taskElement.textContent;
      });

      // Append the new <div> element to the editDiv
      editDiv.appendChild(p);

      // Open the edit_delete div if it is not already open
      if (!edit_delete.classList.contains("open")) {
          edit_delete.classList.add("open");
          edit_delete.classList.remove("close");
      }
  });

  // Make the original task element editable
  taskElement.contentEditable = true;
}

// Handle toggle button click to close the edit_delete div
const toggle = document.getElementById('toggle');
toggle.addEventListener('click', () => {
  if (edit_delete.classList.contains('open')) {
      edit_delete.classList.remove('open');
      edit_delete.classList.add('close');
  }
});


  // Add drag events to task
  function addDragEvents(taskElement) {
      taskElement.addEventListener("dragstart", (e) => {
          e.dataTransfer.setData("text/plain", taskElement.innerHTML);//noted
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

      addDropEvents(createdTaskDiv);// 
  }

  // Add drop events to created task containers
  function addDropEvents(taskContainer) {
      taskContainer.addEventListener("dragover", (e) => e.preventDefault());

      taskContainer.addEventListener("drop", (e) => {
          e.preventDefault();
          const taskText = e.dataTransfer.getData("text/plain");// noted 
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
          addClickEvent(taskDiv);
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

  // Function to handle task editing
  function handleEditFinish() {
      if (input && currentTask) {
          currentTask.textContent = input.value;
          input.remove();
          input = null;
          currentTask = null;
      }
  }

  // Event delegation for editing tasks

  //noted check all down 
  document.addEventListener('dblclick', (event) => {
      if (event.target.classList.contains('taskdiv')) {
          if (!input) {
              currentTask = event.target;
              input = document.createElement('input');
              input.type = 'text';
              input.value = currentTask.textContent;
              input.classList.add('task-input');
              currentTask.textContent = '';
              currentTask.appendChild(input);

              input.addEventListener('keydown', (event) => {
                  if (event.key === 'Enter') {
                      handleEditFinish();
                  }
              });
          }
      }
  });

  // Click outside the input to finish editing
  document.addEventListener('click', (event) => {
      if (input && !input.contains(event.target) && event.target !== input) {
          handleEditFinish();
      }
  });

  // Add click events to existing taskDiv elements
  const taskDivs = document.querySelectorAll(".taskdiv");
  taskDivs.forEach(addClickEvent);
});
