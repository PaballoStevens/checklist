@extends('layouts/checklist')

@section('content')
@php
   $name = App\Models\Checklist::where('id', ($clone->id))->get();
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
         
  <div class="collapse navbar-collapse" id="navbarNav">
    <h2> @foreach ($name as $item)
      {{$item->title}} Checklist Items
    @endforeach 
    </h2>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a href="" style="float: right;" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#exampleModal"> Clone List</a>
      </li>
    </ul>
  </div>
    
</nav>

<div class="container-fluid">
  <div class="card-body">
  <div class="modal fade" id="imModal" tabindex="-1" aria-labelledby="imModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imModalLabel">New item for  @foreach ($name as $item)  {{$item->title}} @endforeach   checklist</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/checklists/new-item" method="post">
              @csrf
              <label for="">Name of item</label><br>
              <input type="text" class="form-control" name="title" id="" required><br>
              <input type="hidden" name="lid" value="{{$clone->id}}">
              <label for="">Who's to lead this?</label><br>
              @php
                   $assignee = App\Models\User::select(['id','name'])->get();
              @endphp
              <select name="assignee" class="form-select" required>
                  <option></option>
                  @foreach ($assignee as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
              </select><br>
              <label for="">Priority of the item</label><br>
              <select name="priority" class="form-select" id="" required>
                  <option></option>
                  <option>Low</option>
                  <option>Medium</option>
                  <option>High</option>
              </select><br>
              <label for="">Description</label><br>
              <textarea type="text" class="form-control" name="description" id=""></textarea><br>
              <button type="submit" class="btn btn-primary">Add Item</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
          </div>
        </div>
      </div>
  </div>
  @php
       $items = App\Models\CheckItem::where('lid', ($clone->lid))->get();

  @endphp
  @foreach ($items as $item)
  <div class="card shadow" style="width: 60rem;">
      <div class="card-body">
           <div>
              <h5><b>{{$item->title}}</b></h5>
                  @if ($item->priority ==='High')
                  <h6><span class="badge bg-success" style="font-size: 20px">High</span> <i class="ti-user" style="font-size:20px;margin-bottom:50px"> {{App\Models\User::where('id', $item->assignee)->get()[0]->name}}</i>
                      @if ($item->status == 0)
                      <a href="/space/checklists/{{$item->id}}"><i class="ti-check" style="float:right;font-size:50px;color:green;font-weight:bold"></i></a> 
                      @else
                      <span class="badge bg-success" style="font-size: 20px; float:right">Complete</span>
                      @endif
                     
                  </h6> 
              </div>
              @elseif($item->priority ==='Medium')
              <h6>         <span class="badge bg-warning" style="font-size: 20px">Medium</span> <i class="ti-user" style="font-size:20px;margin-bottom:50px"> {{App\Models\User::where('id', $item->assignee)->get()[0]->name}}</i>
                  @if ($item->status == 0)
                   <a href="/space/checklists/{{$item->id}}"><i class="ti-check" style="float:right;font-size:50px;color:green;font-weight:bold"></i></a>
                  @else
                      <span class="badge bg-success" style="font-size: 20px; float:right">Complete</span>
                      @endif
              </h6>
          </div>
              @elseif($item->priority ==='Low')
              <h6><span class="badge bg-info" style="font-size: 20px">Low</span> <i class="ti-user" style="font-size:20px;margin-bottom:50px">  {{App\Models\User::where('id', $item->assignee)->get()[0]->name}}</i> 
                  @if ($item->status == 0)
                  <a href="/space/checklists/{{$item->id}}"><i class="ti-check" style="float:right;font-size:50px;color:green;font-weight:bold"></i></a>
                  @else
                      <span class="badge bg-success" style="font-size: 20px; float:right">Complete</span>
                  @endif
              </h6>
          </div>
              @else
                  
              @endif
          {{$item->description}}
      </div>
    </div>
<br>

  @endforeach

   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Clone   Checklist</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/clonelist" method="post">
            @csrf
            @foreach ($name as $item)
            <label for="">Name of the Checklist</label><br>
            <input type="text" class="form-control" name="title" value="{{$item->title}} Clone"><br>
            <label for="">Category</label><br>
            <input type="text" class="form-control" name="category" value="{{$item->category}}"><br>
            <label for="">Description</label><br>
            <textarea type="text" class="form-control" name="description" value="{{$item->description}}"></textarea><br>
            @endforeach
            <input type="hidden" name="author" value="{{Auth::user()->id}}">
            @foreach ($items as $item)
            <input type="hidden" name="title" value="{{$item->title}}">
            <input type="hidden" name="assignee" value="{{$item->assignee}}">
            <input type="hidden" name="priority" value="{{$item->priority}}">
             <input type="hidden" name="dsc" value="{{$item->description}}">
            @endforeach
            
            <button type="submit" class="btn btn-primary">Clone Checklist</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
 
    @endsection   
   

  