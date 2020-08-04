<?php

namespace App\Http\Controllers\api;

use App\Task;
use App\Todo;
use Webpatser\Uuid\Uuid;
use App\Traits\GlobalScopes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{ use GlobalScopes;
    public function createTask(Request $request){
        // return $request;
      $request->validate([
          'project_id' => 'required',
          'task_name' => 'required|unique:tasks',
          'assiged_to' =>'required',
          'start_date' => 'required',
          'end_date' => 'required',
          'task_priority' => 'required',
          'task_description' => 'required',
      ])  ;
      $task = new Task([
        'task_id' => Uuid::generate()->string,
        'project_id' => $request->project_id,
        'company_id' => auth('api')->user()->company->id,
        'task_name' => $request->task_name,
        'assiged_to' => $request->assiged_to,
        'assign_by' =>auth('api')->user()->id,
        'user_id' =>auth('api')->user()->id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'task_priority' => $request->task_priority,
        'task_description' => $request->task_description,
      ]);
      $task->save();
      return response()->json(
        ['message'=>'Successfully created Task'], 201);
    }
    public function updateTask(Request $request,$id){
      $request->validate([
          'project_id' => 'required',
          'task_name' => 'required',
          'assiged_to' =>'required',
          'start_date' => 'required',
          'end_date' => 'required',
          'task_priority' => 'required',
          'task_description' => 'required',
      ]) ;
      $task = Task::Where('id' , $id);
      $task->update([
        'project_id' => $request->project_id,
        'task_name' => $request->task_name,
        'assiged_to' => $request->assiged_to,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'task_priority' => $request->task_priority,
        'task_description' => $request->task_description,
      ]);
      return response()->json(
        ['message'=>'Successfully Updated Task'], 201);
   }
    public function getTaskProjectRecord($id){
        $data = Task::Where('project_id' , $id)->with('assignto')->with('assignby')->get();
        return response()->json(
            $data, 201);
       }
    public function getTaskRecord($id){
        $data = Task::Where('task_id' , $id)->first([
            'id',
        'project_id',
        'task_name',
        'start_date',
        'end_date',
        'task_description',
        'task_priority',
        'assiged_to',
        ]);
        return response()->json(
            $data, 201);
       }
    public function deleteTask($id){
        $data = Task::where('id', $id);
        $data->delete();
        return response()->json([
            'message' => 'Successfully deleted Task!'
        ], 201);
    }
    public function getTaskUnitProjectRecord(){
        $id = auth('api')->user()->employee->id;
        $unittask = Task::where('assiged_to', $id)->with('assignby')->get();
        return response()->json($unittask, 201);
    }
    public function updateTaskStatus(Request $request,$id){
        
        $task = Task::Where('id' , $id);
        $v = $request->task_status;
        if($v == 3){
            $c = 100;
        }else if($v == 2){
            $c =  $this->isCompleted($id);
           
        }else{
            $c = 0;
        }
        $task->update([
          'task_status' => $v,
          'percentage_completed' => $c
        ]);
        return response()->json(
          ['message'=>'Task Staus Updated'], 201);
    }

    public function getTaskName($id){
        $task_name = Task::where('id',$id)->first()->task_name;
        return response()->json(
            $task_name, 201);
      }
    
}
