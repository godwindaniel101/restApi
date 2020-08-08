<?php

namespace App\Http\Controllers\api;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GlobalScopes;
class DashboardController extends Controller
{
    use GlobalScopes;
    public function adminDashboard(){
        // return auth('api')->user()->company->employee;
        $dash_data = [];
        $listEmployee_count = count($this->listEmployee());
        $idleEmployee_count = count($this->idleEmployee());
        $listProject_count = count($this->listProject());
        $dueProject_count = count($this->dueProject());
        $activeProject_count = count($this->activeProject());
        $totaltask= count($this->listTask());
   
        $dash_data['task_count'] = $totaltask;
        $dash_data['idle_employee'] = $idleEmployee_count;
        $dash_data['employee_count'] = $listEmployee_count;
        $dash_data['project_count'] = $listProject_count;
        $dash_data['dueProject_count'] = $dueProject_count;
        $dash_data['activeProject_count'] =$activeProject_count;
        return response()->json($dash_data, 201);
    }

}
