<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TodoTasks as Task;
class TasksController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        $tasks = new Task;
        $tasks->user_id = $user->id;
        $tasks->name=$request->taskname;
        $tasks->save();
        
        return redirect()->back()->with('success', 'Description updated successfully!');
    }
    public function index(){
        $tasklist=Task::all();
        return view("addtasks",['tasklist'=>$tasklist]);
    
        }
        public function index1(){
            $tasklist=Task::all();
            return view("donetasks",['tasklist'=>$tasklist]);
        
            }
        public function destroy($id)
        {
            $task = Task::findOrFail($id);
            $task->delete();
    
            return redirect('/addtasks')->with('success', 'Task deleted successfully.');
        }
        public function updateName(Request $request, $id)
        {
            $task = Task::findOrFail($id);
            $task->name = $request->input('name');
            $task->save();
    
            return redirect('/addtasks')->with('success', 'Task name updated successfully.');
        }
        public function donefunction( $id)
        {
            $task = Task::findOrFail($id);
            $task->done = "done";
            $task->save();
    
            return redirect('/addtasks')->with('success', 'Task name updated successfully.');
        }
}
