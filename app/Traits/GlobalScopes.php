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

     public function idleEmployee(){
        $free_employee = [];
        $companies_employee = auth('api')->user()->company->employee;
        foreach($companies_employee as $employee){
            $data = $employee->task;       
            if($data == null){
                array_push( $free_employee,['employee_name'=>$employee->first_name ,'employee_id'=>$employee->id ]);
            };
        }
        return $free_employee;
     }

     public function listEmployee(){
        return auth('api')->user()->company->employee;
     }
     public function listProject(){
         return auth('api')->user()->company->project;
     }
     public function dueProject(){
      $data = auth('api')->user()->company->with('project')
        ->whereHas('project' ,function($q){
         $q->where('end_date', '>=', today()->format('Y-m-d'));
        })->get();
        return $data;
     }
     public function activeProject(){
        return auth('api')->user()->company->with('project')
        ->whereHas('project' ,function($q){
          $q->where('ast_project_supervisor', "5");
        })->get();
     }
     public function listTask(){
        return auth('api')->user()->company->task;
     }
}
?>