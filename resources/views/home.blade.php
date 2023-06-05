@extends('layouts.layout')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
  body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 0.88rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  text-align: left;
}

i {
  font-style: italic;
}

.container{
  margin-top:100px;
  widows: 850%;
}

.card {
  box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
  border-width: 0;
  transition: all .2s;
}

.card-header:first-child {
  border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}

.card-header {
  display: flex;
  align-items: center;
  border-bottom-width: 1px;
  padding-top: 0;
  padding-bottom: 0;
  padding-right: 0.625rem;
  height: 3.5rem;
  background-color: #fff;
}
.widget-subheading{
  color: #858a8e;
  font-size: 10px;
}
.card-header.card-header-tab .card-header-title {
  display: flex;
  align-items: center;
  white-space: nowrap;
}

.card-header .header-icon {
  font-size: 1.65rem;
  margin-right: 0.625rem;
}

.card-header.card-header-tab .card-header-title {
  display: flex;
  align-items: center;
  white-space: nowrap;
}

.btn-actions-pane-right {
  margin-left: auto;
  white-space: nowrap;
}

.text-capitalize {
  text-transform: capitalize !important;
}

.scroll-area-sm {
  height: 288px;
  overflow-x: hidden;
}

.list-group-item {
  position: relative;
  display: block;
  padding: 0.75rem 1.25rem;
  margin-bottom: -1px;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.125);
}

.list-group {
  display: flex;
  flex-direction: column;
  padding-left: 0;
  margin-bottom: 0;
}

.todo-indicator {
  position: absolute;
  width: 4px;
  height: 60%;
  border-radius: 0.3rem;
  left: 0.625rem;
  top: 20%;
  opacity: .6;
  transition: opacity .2s;
}


.widget-content {
  padding: 1rem;
  flex-direction: row;
  align-items: center;
}

.widget-content .widget-content-wrapper {
  display: flex;
  flex: 1;
  position: relative;
  align-items: center;
}

.widget-content .widget-content-right.widget-content-actions {
  visibility: hidden;
  opacity: 0;
  transition: opacity .2s;
}

.widget-content .widget-content-right {
  margin-left: auto;
}

.btn:not(:disabled):not(.disabled) {
  cursor: pointer;
}

.btn {
  position: relative;
  transition: color 0.15s, background-color 0.15s, border-color 0.15s, box-shadow 0.15s;
}

.btn-outline-success {
  color: #3ac47d;
  border-color: #3ac47d;
}

.btn-outline-success:hover {
  color: #fff;
  background-color: #3ac47d;
  border-color: #3ac47d;
}

.btn-outline-success:hover {
  color: #fff;
  background-color: #3ac47d;
  border-color: #3ac47d;
}
.btn-primary {
  color: #fff;
  background-color: #3f6ad8;
  border-color: #3f6ad8;
}
.btn { 
  position: relative;
  transition: color 0.15s, background-color 0.15s, border-color 0.15s, box-shadow 0.15s;
  outline: none !important;
}

.card-footer{
  background-color: #fff;
}
</style>

@section('content')
<div class="main_content_iner ">
  <div class="container-fluid p-0">
  <div class="row justify-content-center">
  <div class="col-12">
  <div class="dashboard_header mb_50">
  <div class="row">
  <div class="col-lg-6">
  <div class="dashboard_header_title">
  <h3> Dashboard</h3>
  </div>
  </div>
  <div class="col-lg-6">
  <div class="dashboard_breadcam text-end">
  <p><a href="">Dashboard</a> <i class="fa fa-caret-right"></i> Data Table</p>
  </div>
  </div>
  </div>
  </div>
  </div>
   <div class="col-12">
  <div class="QA_section">
  <div class="white_box_tittle list_header">
  <h4>Table</h4>
  <div class="box_right d-flex lms_block">
  <div class="serach_field_2">
  <div class="search_inner">
  <form Active="#">
  <div class="search_field">
  <input type="text" placeholder="Search content here...">
  </div>
  <button type="submit"><i class="fa fa-search" style="margin-bottom: 10px"></i> </button>
  </form>
  </div>
  </div>
  <div class="add_button ms-2">
  <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" class="btn bg-info text-white"> Create a checklist</a>
  </div>
  </div>
  </div>
  <div class="QA_table mb_30">
  
  <table class="table lms_table_active">
  <thead>
  <tr>
  <th scope="col">No</th>
  <th scope="col">Category</th>
  <th scope="col">Author</th>
  <th scope="col">Created_at</th>
  <th scope="col">Manage Checklist</th>
  </tr>
  </thead>
  <tbody>
 
 @foreach ($checklist as $item)
 <tr>
  <th scope="row"> <a href="#" class="question_content"> {{$item->id}}</a></th>
  <td><a href="/preview/{{$item->listName}}">{{$item->listName}}</a></td>
  <td>{{$item->name}}</td>
  <td>{{$item->created_at}}</td>
  <td><a href="/manage/{{$item->listName}}" class="btn bg-light">Manage Checklist</a></td>
  </tr>
  <tr>
   @endforeach 
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>  

 <!-- The Modal -->
 <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="row d-flex justify-content-center container"> 
        <div class="card-header-tab card-header">
          <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
              class="fa fa-tasks"></i>&nbsp;Checklists</div> 
        </div>
      <div class="m-top-110"></div>
      <form action="/home" method="Post">
          @csrf
          <div>
            <br/>
            <div class="mb-6">
              <div class="dropdown">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  List Names
                </button>
                
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li> <a class="dropdown-item" id="button" href="#">Blank</a></li>
                  @foreach ($checklist as $item)
                  <li><a class="dropdown-item" href='/checklist/{{$item->listName}}'>{{$item->listName}}</a></li>
                  @endforeach
                </ul>
              </div>
              <br/>
               <div id='form'></div>
               <div id="create"></div>
               <br/>
               <p class="btn bg-light text-black" id="createbtn">Add More Check</p>
          </div>
          <div class="modal-footer">
      <button class="btn btn-danger text-white" type="button" data-bs-dismiss="modal">Cancel</button>
      <button class="btn btn-primary text-white" type="submit" >Add checklist</button>
  </div>
      </form>
    </div>
  </div>
</div>


<script>

 const createbtn = document.querySelector('#createbtn');
 const create = document.querySelector('#create');

 let test = 1;
 

  createbtn.addEventListener('click', function() {
    let inputs = '';
    for(let i = 0; i < test; i++) {
      inputs += `<br/> <label for="exampleInputEmail1" class="form-label">Item</label>
              <input type="text" name="list[]" class="form-control" >
              <div class="mb-6">
              <label for="exampleInputPassword1" class="form-label">assign</label>
              <br/>
              <select class="form-select" name="assign[]" >
                  @foreach ($users as $item)
                     @if (Auth::user()->id == $item->id)
                     <option value="{{$item->id}}">Me</option>
                     @else
                      <option value="{{$item->id}}">{{$item->name}}</option>
                     @endif
                      
                  @endforeach
                     
                  </select>
            </div>
            <br/>
            
      `;
    }
    create.innerHTML = inputs;
    test++;
  });
</script>

<script>
  const button = document.querySelector('#button');
  const form = document.querySelector('#form');

  button.addEventListener('click', function() {
    form.innerHTML = `
   
    <label for="exampleInputPassword1" class="form-label">Checklist Name</label>
              <br/>
              <input type="text" name="listName" class="form-control" id='test'>
            </div>
              <input type="hidden" name="userid" value='{{ Auth::user()->id }}'/>
              <br>
              
              <div id="chapter"></div>
              <label for="exampleInputEmail1" class="form-label">Item</label>
              <input type="text" name="list[]" class="form-control" >
              <div class="mb-6">
              <label for="exampleInputPassword1" class="form-label">assign</label>
              <br/>
              <select class="form-select" name="assign[]" >
                  @foreach ($users as $item)
                     @if (Auth::user()->id == $item->id)
                     <option value="{{$item->id}}">Me</option>
                     @else
                      <option value="{{$item->id}}">{{$item->name}}</option>
                     @endif
                      
                  @endforeach
                     
                  </select>
                  
                
            </div>
      
    `;
  });
</script>


@endsection


