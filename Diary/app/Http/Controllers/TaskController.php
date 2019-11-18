<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;  //include task.php model

class TaskController extends Controller
{
    public function store(Request $request){
        //dd($request->all()); 
        $task=new Task;

        $this->validate($request,[
            'task'=>'required|max:100|min:5',
        ]);
        $task->task=$request->task;
        $task->save();
        $data=Task::all();
        //dd($data);
       // return redirect()->back();
       return view('task ')->with('tasks',$data);
    }
    public function UpdateTaskAsCompleted($id){
        $task=Task::find($id);
        $task->iscompleted=1;
        $task->save();
        return redirect()->back();
        
    }
    public function UpdateTaskAsNotCompleted($id){
        $task=Task::find($id);
        $task->iscompleted=0;
        $task->save();
        return redirect()->back();
    }
    public function DeleteTask($id){
        $task=Task::find($id);
        
        $task->delete();
        return redirect()->back();
    }
    public function UpdateTask ($id){
        $task=Task::find($id);
        
        return view('updatetask ')->with('taskdata',$task);

    }
    public function UpdateTasks(Request $request){
        $id=$request->id;
        $task=$request->task;
        $data=Task::find($id);
        $data->task=$task;
        $data->save();
        $data=Task::all();

        return view('task')->with('tasks',$data);
        
    }
} 
