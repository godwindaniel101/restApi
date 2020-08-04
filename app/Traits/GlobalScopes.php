<?php
namespace App\Traits;

use App\Task;
use App\Todo;

trait GlobalScopes{
    public function isCompleted($id){
       $tasks= Todo::where('task_id' , $id); 
        $total_task = count($tasks->get());
        $completed_task = count($tasks->where('is_completed' , 1)->get());
        if($completed_task > 0){
                $percentageCompleted =  round(($completed_task/$total_task *100),2);
        }else{
            $percentageCompleted = 0;
        }
        return $percentageCompleted;
    }
    public function isCompletedUpdate($id){
        $tasks= Todo::where('task_id' , $id); 
         $total_task = count($tasks->get());
         $completed_task = count($tasks->where('is_completed' , 1)->get());
         if($completed_task > 0){
                 $percentageCompleted =  round(($completed_task/$total_task *100),2);
         }else{
             $percentageCompleted = 0;
         }
         Task::where('id',$id)->update([
             'percentage_completed'=> $percentageCompleted
         ]);
         return $percentageCompleted;
     }
     public function isCompletedUserUpdate(){
        $employee_id = auth('api')->user()->employee->id;
        $todos= Task::where('assiged_to' , $employee_id)->get(); 
        // return $todos;
                foreach($todos as $todo){
                    if($todo->id != null){
                 $this->isCompletedUpdate($todo->id);}
                }
                return 'done';
     }
}
?>