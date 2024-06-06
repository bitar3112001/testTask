<x-sidebar>
    <form action="/admin/assignment" method="POST">
       @csrf 
       <h1 class="hello">welcome to task managment  </h1>
    
       <h2>deploy your project/task </h2>
      <br>
      <label for=""> select task or project </label>
      <br>
      <input type="radio" name="type"   value="project">
      <label for="project">project</label>
      <br>
      <input type="radio" name="type"  value="task">
      <label for="task">Task</label>
    <br><br>
      <label for="">name your task/project</label>
      <input class="form-control" type="text" name="name" >
      <br><br>
      <label for="">deploy date </label>
      <input type="date" name="deploy_date">
      <br><br>
      <label for="">submit date </label>
      <input type="date" name="submit_date">
    <br><br>

    
    <input type="submit">
    
    
    </form>
    @if(session()->has('succes'))
    <p>{{session('succes')}}</p>
    @endif
    @error('type')
    <p>{{ $message }}</p>
    @enderror
    
    @error('name')
    <p>{{ $message }}</p>
    @enderror

    @error('deploy_date')
    <p>{{ $message }}</p>
    @enderror

    @error('submit_date')
    <p>{{ $message }}</p>
    @enderror
</x-sidebar>


   