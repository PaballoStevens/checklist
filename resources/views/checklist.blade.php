@extends('layouts/checklist')

@section('content')

<div class="container">
 
  @if (Request::get('a') == 'view')
  @php
      $list = App\Models\Checklist::where('id', $_GET['lid'])->get();
  @endphp
  
  @if (count($list) > 0)
  @php
  $items = App\Models\CheckItem::where('lid', $list[0]->id)->get();
  @endphp
  <h2>{{ $list[0]->title }} Checklist Items ({{count($items)}})
      <button class="btn btn-success btn-sm" style="float:right"  data-bs-toggle="modal" data-bs-target="#imModal">Add Item</button>
  </h2>
   @include('viewlist')
  
  @else
      
  @endif
     
  @else
      @php
      $lists = App\Models\Checklist::OrderByDesc('created_at')->get();
      $i = 1;
  @endphp
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         
          <div class="collapse navbar-collapse" id="navbarNav">
            <h2>Checklists ({{ count($lists) }})</h2>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
          <a href="" style="float: right;" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#exampleModal"> New List</a>
              </li>
            </ul>
          </div>
            
      </nav>
      @if (count($lists) < 1) 
          <h4>No lists yet</h4>
      @else
      <table class="table table-hover table-stripped">
          <thead>
              <th>#</th>
              <th>List Name</th>
              <th>Category</th>
              <th>Author</th>
              <th>No. Items</th>
              <th>Add Item</th>
              <th>Action</th>
          </thead>
  
          <tbody>
              @foreach ($lists as $l)
              <tr>
                  <td>{{$i}}</td>
                  <td><a href="/space/checklists?a=view&lid={{$l->id}}" style="text-decoration: none;" class="text-danger"><b>{{$l->title}}</b></a></td>
                  <td>{{$l->category}}</td>
                  <td>{{App\Models\User::where('id', $l->author)->get()[0]->name}}</td>
                  <td>{{count(App\Models\CheckItem::where('lid', $l->id)->get())}} Items</td>
                  <td><button class="btn btn-success btn-sm"  data-bs-toggle="modal" data-bs-target="#im{{$l->id}}Modal">Add Item</button></td>
  
                  <div class="modal fade" id="im{{$l->id}}Modal" tabindex="-1" aria-labelledby="im{{$l->id}}ModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="im{{$l->id}}ModalLabel">New item for {{$l->title}} checklist</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="/checklists/new-item" method="post">
                              @csrf
                              <label for="">Name of item</label><br>
                              <input type="text" class="form-control" name="title" id="" required><br>
                              <input type="hidden" name="lid" value="{{$l->id}}">
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
  
                  <td>
                      <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/edit/{{$l->id}}"><i class="ti-pencil"></i> Edit</a></li>
                            <li><a class="dropdown-item" href="#!"  data-bs-toggle="modal" data-bs-target="#cl{{$l->id}}Modal"><i class="far fa-copy"></i> Clone</a></li>
                            <li><a class="dropdown-item" href="{{route('delete', ['id' => $l->id])}}"><i class="ti-trash"></i> Delete</a></li>
                          </ul>
                        </div>
                  </td>
              </tr>
              @php $i++;  @endphp
              <div class="modal fade" id="cl{{$l->id}}Modal" tabindex="-1" aria-labelledby="cl{{$l->id}}ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="cl{{$l->id}}ModalLabel">Clone   Checklist</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="cl{{$l->id}}modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/checklists/clonelist" method="post">
                        @csrf
                        <label for="">Name of the Checklist</label><br>
                        <input type="text" class="form-control" name="title" value="{{$l->title}} Clone"><br>
                        <label for="">Category</label><br>
                        <input type="text" class="form-control" name="category" value="{{$l->category}}"><br>
                        <label for="">Description</label><br>
                        <textarea type="text" class="form-control" name="description" value="{{$l->description}}"></textarea><br>
                         <input type="hidden" name="author" value="{{Auth::user()->id}}">
                         <input type="hidden" name="lid" value="{{$l->id}}">
                         <input type="hidden" name="id" value="{{$l->id}}">
                         @php
                             $clone = App\Models\CheckItem::where('lid', $l->id)->get();
                         @endphp
                         @foreach ($clone as $cl)
                         <input type="hidden" name="titles" value="{{$cl->title}}">
                         <input type="hidden" name="assignee" value="{{$cl->assignee}}">
                         <input type="hidden" name="priority" value="{{$cl->priority}}">
                          <input type="hidden" name="dsc" value="{{$cl->description}}">
                         @endforeach
                        <button type="submit" class="btn btn-primary">Clone Checklist</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      
                    </div>
                  </div>
                </div>
              @endforeach
          </tbody>
      </table>
      @endif
   </div>
   
  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Checklist</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/checklists/new" method="post">
              @csrf
              <input type="hidden" name="author" value="{{Auth::user()->id}}">
              <label for="">Name of the Checklist</label><br>
              <input type="text" class="form-control" name="title" id=""><br>
              <label for="">Category</label><br>
              <input type="text" class="form-control" name="category" id=""><br>
              <label for="">Description</label><br>
              <textarea type="text" class="form-control" name="description" id=""></textarea><br>
              <button type="submit" class="btn btn-primary">Submit Checklist</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
      @endif
    </div>
    
@endsection
 
 


 