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
  <a href="/home" style="text-decoration: none"><h3> Dashboard</h3></a>
  </div>
  </div>
  <div class="col-lg-6">
  <div class="dashboard_breadcam text-end">
  <p><a href="">Preview</a> <i class="fa fa-caret-right"></i> {{$name}}</p>
  </div>
  </div>
  </div>
  </div>
  </div>
   <div class="col-12">
  <div class="QA_section">
  <div class="white_box_tittle list_header">
    <h4>{{$name}} Checklist</h4>
  <div class="box_right d-flex lms_block">
  <div class="serach_field_2">
  <div class="search_inner">
  </div>
  </div>
  <div class="add_button ms-2">
    <a href="#" data-bs-toggle="modal" data-bs-target="#myClone" class="btn btn-outline-success">Clone</a>
  </div>
  </div>
  </div>
 
  <div class="row d-flex justify-content-center container">
    <div class="col-md-8">
      <div class="card-hover-shadow-2x mb-3 card">
        <div class="card-header-tab card-header">
          <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
              class="fa fa-tasks"></i>&nbsp;{{$name}}</div>
        </div>
        <div class="scroll-area-sm">
          <perfect-scrollbar class="ps-show-limits">
            <div style="position: static;" class="ps ps--active-y">
              <div class="ps-content">
                <ul class=" list-group list-group-flush">
                  @foreach ($edit as $item)
                          <li class="list-group-item">
                              <div class="todo-indicator bg-danger"></div>
                              <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left mr-2">
                                    <div class="custom-checkbox custom-control">
                                      <input class="custom-control-input"
                                        id="exampleCustomCheckbox12" type="checkbox"><label class="custom-control-label"
                                        for="exampleCustomCheckbox12">&nbsp;</label>
                                      </div>
                                  </div>
                                  <div class="widget-content-left">
                                    <div class="widget-heading"> {{$item->list}}<div class="badge badge-danger ml-2">Pending</div>
                                    </div>
                                    <div class="widget-subheading"><i>Assign to @if ($item->assign == Auth::user()->id)
                                      Me
                                  @else
                                      {{$item->name}}
                                  @endif 
                                       
                                    </i></div>
                                  </div>
                                <div class="widget-content-right">
                                </div>
                                </div>
                              </div>
                            </li>
                          @endforeach    
                </ul>
              </div>
            </div>
          </perfect-scrollbar>
        </div>
        <div class="d-block text-right card-footer"></div>
      </div>
    </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  
  <div class="modal" id="myClone">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="row d-flex justify-content-center container">
            <form action="{{ route('clone') }}" method="Post">
              @csrf
            <div class="card-hover-shadow-2x mb-3 card">
              <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="fa fa-tasks"></i>&nbsp;{{$name}}Clone Checklist</div>
              </div>
               <br/>
           
                <label for=""  class="form-label">List Name</label>
               <input type="text" name="listName" class="form-control" value="{{$item->listName}} clone" required>
               <input type="hidden" name="userid" class="form-control" value="{{$item->userid}} " required>
               <br>
              <div class="scroll-area-sm">
                <perfect-scrollbar class="ps-show-limits">
                  <div style="position: static;" class="ps ps--active-y">
                    <div class="ps-content">
                      <ul class=" list-group list-group-flush">
                          @foreach ($edit as $item)
                          <label for=""  class="form-label">Item</label>
                        <input type="text" name="list[]" class="form-control" value="{{$item->list}}" required>
                          <br>
                          <label for=""  class="form-label">assign</label>
                          <select name="assign[]" class="form-select" required>
                            <option value="{{$item->assign}}">{{$item->assign}}</option>
                            @foreach ($users as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          </select>
                          <br>
                          @endforeach
                          <div id="task"></div>
                        <div>
                          <a id="add" class="btn bg-success ml-2 text-white">Add checklist</a>
                        </div>
                      </ul>
                    </div>
                  </div>
                  <br/>
                </perfect-scrollbar>
              </div>
              <div class="d-block text-right card-footer"><button class="mr-2 btn btn-link btn-sm"  data-bs-dismiss="modal">Cancel</button><button
                  class="btn btn-primary" type="submit">Save</button></div>
            </div>
          </form>
          </div>
      
          </div>
      </div>
    </div>
  </div>

  <script>

    const add = document.querySelector('#add');
    const task = document.querySelector('#task');
    let test = 1;
    
    add.addEventListener('click', function() {
      let inputs = '';
      const existingInputs = task.querySelectorAll('input[name="list[]"]');
      const existingValues = [];
      for(let i = 0; i < existingInputs.length; i++) {
        existingValues.push(existingInputs[i].value);
      }
      for(let i = 0; i < test; i++) {
        const value = existingValues[i] || '';
        inputs += `<input type="text" name="list[]" class="form-control" >
                    <br/>
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
      task.innerHTML = inputs;
      test++;
    });
    
      </script>


@endsection


