<?php

namespace App\Http\Controllers\api;

use App\Task;
use App\Todo;
use App\Traits\GlobalScopes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{  use GlobalScopes;

    public function addTodo(Request $request, $id = null)
    {
        // return $id;
        $user_id = auth('api')->user()->id;

        $todo = new Todo([
            'user_id' => $user_id,
            'task_id' => $id,
            'todo_text' => $request->todo_text,
            'is_completed' => false,
        ]);
        $todo->save(); 
        return response()->json(
            ['message' => 'Todo Staus Created'],
            201
        );
    }
    public function getTodo($id = null)
    {
        if ($id != null) {
            $data = Todo::where('task_id', $id)->orderBy('created_at' , 'desc')->get();
            return response()->json(
                $data,
                201
            );
        }
        $user_id = auth('api')->user()->id;
        $data = Todo::where('user_id', $user_id)->get();
        return response()->json(
            $data,
            201
        );
    }
    public function testData(){
        return 'working';
    }
    public function completeTodo($id)
    {;
        $todo =  Todo::where('id', $id);
        $is_completed = !$todo->first()->is_completed;
        $todo->update(['is_completed' => $is_completed]);
        $task_id = $todo->first()->task_id;
        // return $task_id;
        $this->isCompletedUpdate($task_id);
        return response()->json(
            ['message' => 'Todo Updated'],
            201
        );
    }
        public function completeAllTodo(Request $request, $id=null){
            $user_id = auth('api')->user()->id;

            if($id === null){
                $todo =  Todo::where('user_id', $user_id);
                $todo->update([
                    'is_completed' => $request->all_task
                ]);  
                $this->isCompletedUserUpdate();
                return response()->json(
                    ['message' => 'All Your Todo Updated'],
                    201
                );
            }
            $todo =  Todo::where('task_id', $id);
            $todo->update([
                'is_completed' => $request->all_task
            ]);
            $this->isCompletedUpdate($id);
            return response()->json(
                ['message' => 'All Todo Updated'],
                201
            );
        }
        public function deleteTodo($id){
            $todo =  Todo::where('id', $id);
            $task_id = $todo->first()->task_id;
            $todo->delete();
            $this->isCompletedUpdate($task_id);
            return response()->json(
                ['message' => 'Todo Deleted'],
                201
            );
        }
        public function deleteAllTodo($id){
            $employee = auth('api')->user()->employee->id;
            if($id === null){
                $todo =  Todo::where('user_id', $employee);
                $todo->delete();
                $this->isCompletedUserUpdate();
                return response()->json(
                    ['message' => 'All Your Todo Deleted'],
                    201
                );
            }
            $todo =  Todo::where('task_id', $id);
            $todo->delete();
            $this->isCompletedUpdate($id);
            return response()->json(
                ['message' => 'All Todo Deleted'],
                201
            );
            
        }
        
        
}
