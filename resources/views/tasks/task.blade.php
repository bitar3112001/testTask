

<x-sidebar>
<h1>task view</h1>
<h2>apply the tasks for the main project</h2>
<form action="/admin/task" method="POST">
@csrf

<label for="">deploy date </label>
<input type="date" name="deploy_date">
<br><br>
<label for="">submit date </label>
<input type="date" name="submit_date">
<br><br>

<h3>choose the project that will assign for it the tasks</h2>
<select name="project_id" id="project_id">
  @forelse ($projects as $project)
      <option value="{{ $project->id }}">{{ $project->name }}</option>
  @empty
      <option value="">No projects available</option>
  @endforelse
</select>

<textarea name="description" id="description_task" cols="10" rows="5"></textarea>

<input type="submit">
</form>
@if(session()->has('succes'))
    <p>{{session('succes')}}</p>
    @endif
  
    @error('project_id')
    <p>{{ $message }}</p>
    @enderror

    @error('deploy_date')
    <p>{{ $message }}</p>
    @enderror

    @error('submit_date')
    <p>{{ $message }}</p>
    @enderror
    @error('description')
    <p>{{ $message }}</p>
    @enderror
    @error('error')
    <p>{{ $message }}</p>
    @enderror

</x-sidebar>

 {{-- tiny mce link and script  --}}

 <script src="https://cdn.tiny.cloud/1/hjoktz3fubxkp1hlp3zs4289mjci32ivz3stcq1hv51sg0nd/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
 <script>
     tinymce.init({ 
       selector: '#description_task', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists image',
       toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image',
       image_title: true,
       automatic_uploads: true,
       file_picker_types: 'image',
       file_picker_callback: function (cb, value, meta) {
         var input = document.createElement('input');
         input.setAttribute('type', 'file');
         input.setAttribute('accept', 'image/*');
         input.onchange = function () {
           var file = this.files[0];
           var reader = new FileReader();
           reader.onload = function () {
             var id = 'blobid' + (new Date()).getTime();
             var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
             var base64 = reader.result.split(',')[1];
             var blobInfo = blobCache.create(id, file, base64);
             blobCache.add(blobInfo);
             cb(blobInfo.blobUri(), { title: file.name });
           };
           reader.readAsDataURL(file);
         };
         input.click();
       }
     });
   </script>
 
 
 