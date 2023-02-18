@extends('layouts.layout')
@section('addtasks')
<p class="typewriter">Note your tasks here  !</p>

@foreach ($tasklist as $task)
@if($task->done!="done")

<button type="button" class="taskname" data-bs-toggle="modal" data-bs-target="#challengeModal{{$task->id}}"> 
 {{$task->name}}

</button> <br> <br>
<!-- Modal -->
<div class="modal fade" id="challengeModal{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="challengeModalLabel{{ $task->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title task" id="challengeModalLabel{{$task->id}}">{{$task->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

 <p>{{$task->description}}</p>

<form method="POST" action="{{ route('tasks.updateName', ['id' => $task->id]) }}">
    @csrf
 
    <input type="text" class="form-control" id="updatetask" name="name" placeholder="Update this task">
<button type="submit" class="btn  mb-3" id="updatebtn"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> update
   
      
</form>
<form method="POST" action="{{ route('tasks.donefunction', ['id' => $task->id]) }}">
    @csrf
 
<button type="submit" class="btn  mb-3" id="updatebtn"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> done
   
      
</form>
    <form method="POST" action="{{ route('tasks.destroy', ['id' => $task->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
</form>
       
      </div>
    
      
    </div>
  </div>
</div>
    </div>
    @endif
@endforeach

<form action="{{ route('addtask.create') }}" method="POST">
    @csrf 

<input type="text" class="form-control" id="addtask" name="taskname" placeholder="name@example.com">
<button type="submit" class="btn  mb-3" id="addbtn"> <i class="fa fa-plus" aria-hidden="true"></i> Add
    </button>
  

@endsection