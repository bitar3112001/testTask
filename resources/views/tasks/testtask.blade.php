<x-sidebar>
    <div class="edit_bar box-content">
        <div class="close-btn"></div>
        <div class="items">
            <div class="parent_child"></div>
            <div class="description-container">
                <span class="description_click" style="cursor: pointer;">Add a description</span>
                <div class="description-editor" style="display: none;">
                    <textarea id="descriptionEditor"></textarea>
                    <button id="saveDescription">Save</button>
                    <button id="cancelDescription">Cancel</button>
                </div>
                <div class="description-data" style="cursor: pointer;"></div>
            </div>
            <div class="comment" style="margin-top: 25px;">
                <span class="comment_click" style="cursor: pointer;">Add a comment</span>
                <div class="tiny_comment" style="display: none;">
                    <textarea name="comment" id="comment" cols="60" rows="5"></textarea>
                    <button class="save_comment">Add</button>
                    <button class="cancel_comment" style="display: none;">Cancel</button>
                </div>
                <div id="commentContainer"></div>
            </div>
        </div>
    </div>
</x-sidebar>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const descriptionClick = document.querySelector('.description_click');
    const descriptionEditor = document.querySelector('.description-editor');
    const descriptionData = document.querySelector('.description-data');
    const saveDescription = document.getElementById('saveDescription');
    const cancelDescription = document.getElementById('cancelDescription');

    let originalDescription = ''; // Store the original description

    // Check if there is existing description data
    if (descriptionData.innerHTML) {
        descriptionClick.style.display = 'none'; // Hide button if description exists
    }

    descriptionClick.addEventListener('click', () => {
        // Store the current description before editing
        originalDescription = descriptionData.innerHTML || '';
        descriptionClick.style.display = 'none';
        descriptionEditor.style.display = 'block';
        descriptionData.style.display = 'none'; // Hide description data
        tinymce.get("descriptionEditor").setContent(originalDescription);
        tinymce.execCommand("mceFocus", false, "descriptionEditor");
    });

    descriptionData.addEventListener('click', () => {
        if (descriptionData.innerHTML) {
            originalDescription = descriptionData.innerHTML; // Store current description
            descriptionClick.style.display = 'none';
            descriptionEditor.style.display = 'block';
            descriptionData.style.display = 'none'; // Hide description data
            tinymce.get("descriptionEditor").setContent(originalDescription);
            tinymce.execCommand("mceFocus", false, "descriptionEditor");
        }
    });

    saveDescription.addEventListener('click', () => {
        const content = tinymce.get("descriptionEditor").getContent();
        if (content) {
            descriptionData.innerHTML = content; // Update with the new description
            descriptionEditor.style.display = 'none';
            descriptionClick.style.display = 'none'; // Hide button after adding description
            descriptionData.style.display = 'block'; // Show description data
        } else {
            alert("Description cannot be empty."); // Alert if the description is empty
        }
    });

    cancelDescription.addEventListener('click', () => {
        descriptionEditor.style.display = 'none';
        // Only show the button if there is no description set
        if (!descriptionData.innerHTML) {
            descriptionClick.style.display = 'inline';
        }
        descriptionData.innerHTML = originalDescription; // Restore original description
        descriptionData.style.display = 'block'; // Show description data
    });

    // Initialize TinyMCE
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
        }
    });
});


</script>
