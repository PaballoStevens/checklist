@extends('layouts/checklist')

@section('content')


<nav class="navbar navbar-expand-lg navbar-light bg-light">
         
  <div class="collapse navbar-collapse" id="navbarNav">
      <h2>{{$edit->title}} Edit</h2>
  </div>
     
</nav>

    <div class="card shadow">
        <div class="card-body">
            <div class="card-header">
               <h2 class="text-center"> {{$edit->title}} update</h2>
            </div><br>
            <form action="/edit" method="post">
              @csrf
             <input type="hidden" name="lid" value="{{$edit->id}}">
            <label class="form-label">Name of the Checklist</label>
            <input type="text" class="form-control" name="title" value="{{$edit->title}}" required><br>
            <label class="form-label">Category</label>
            <input type="text" class="form-control" name="category" value="{{$edit->category}}"  required><br>
            <label class="form-label">Description</label>
            <textarea type="text" class="form-control" name="description"  required>{{$edit->description}}</textarea><br>
            <button type="submit" class="btn btn-lg bg-primary text-white">Update Checklist</button>
        </form>
        </div>
    </div>


    @endsection   
   

  