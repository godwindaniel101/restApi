<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Company;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function createEmployee(Request $request){
        $request->validate([
            'email'=>'required|unique:users|email:rfc,dns',
            'phone_no' => 'required|numeric',
            // 'password' => 'required|string',
        ]);
        $user = new User([
            'name' => $request->first_name . ' ' . $request->first_name,
            'company_id' => auth('api')->user()->company_id,
            'email' => $request->email,
            'user_role' =>$request->access_level,
            'phone_no' => $request->phone_no,
            'password' => bcrypt(12345678),
        ]);
        $user->save();
        $employee = new Employee([
            'user_id' => $user->id,
            'company_id' => auth('api')->user()->company->id ,
            'first_name' =>$request->first_name , 
            'last_name' =>$request->last_name ,
            'middle_name' =>$request->middle_name ,
            'date_of_birth' =>$request->date_of_birth ,
            'martial_status' =>$request->martial_status ,
            'sex' =>$request->sex ,
            'phone_no' =>$request->phone_no ,
            'alt_phone_no' =>$request->alt_phone_no ,
            'email' =>$request->email ,
            'department' =>$request->department ,
            'position' =>$request->position ,
            'salary' =>$request->salary ,
            'access_level' =>$request->access_level ,
            'experience_years' =>$request->experience_years ,
            'employee_type' =>$request->employee_type ,
            'qualification' =>$request->qualification ,
            'employee_type' =>$request->employee_type ,
            'start_date' =>$request->start_date ,
            'country' =>$request->country ,
            'state' =>$request->state ,
            'city' =>$request->city ,
        ]);
        $employee->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    public function updateEmployee(Request $request , $id){
        $employee = Employee::where('id',$id)->first();
        // return $employee->users->id;
        
        $request->validate([
            'email' => 'unique:users,email,'.$employee->user->id,
            'phone_no' => 'required|numeric',
        ]);
        
        $employee->user->update([
            'name' => $request->first_name . ' ' . $request->middlename . ' '. $request->lastname,
            'company_id' => auth('api')->user()->company_id,
            'email' => $request->email,
            'user_role' =>$request->access_level,
            'phone_no' => $request->phone_no,
        ]);
        $employee->update([
            'company_id' => auth('api')->user()->company->id ,
            'first_name' =>$request->first_name , 
            'last_name' =>$request->last_name ,
            'middle_name' =>$request->middle_name ,
            'date_of_birth' =>$request->date_of_birth ,
            'martial_status' =>$request->martial_status ,
            'sex' =>$request->sex ,
            'phone_no' =>$request->phone_no ,
            'alt_phone_no' =>$request->alt_phone_no ,
            'email' =>$request->email ,
            'department' =>$request->department ,
            'position' =>$request->position ,
            'salary' =>$request->salary ,
            'access_level' =>$request->access_level ,
            'experience_years' =>$request->experience_years ,
            'employee_type' =>$request->employee_type ,
            'qualification' =>$request->qualification ,
            'employee_type' =>$request->employee_type ,
            'start_date' =>$request->start_date ,
            'country' =>$request->country ,
            'state' =>$request->state ,
            'city' =>$request->city ,
        ]);
         return response()->json([
            'message' => 'Successfully updated User!'
        ], 201);
    }
    public function getEmployee(){
      $id = auth('api')->user()->company->id;
      $data = Employee::where('company_id' , $id)->get([
          'first_name' , 
          'last_name',
          'id',
          'department',
          'position',
          'phone_no',
          'sex',
          'start_date',
          'email']);
      return response()->json(
         $data, 201);
    }
    public function getEmployeeRecord($id){
        $data = Employee::where('id', $id)->first();
        return response()->json(
            $data, 201);
       }
    public function deleteEmployee($id){
        $data = Employee::where('id', $id);
        $employee = $data->first();
        $employee->user->delete();
        $employee->delete();
        return response()->json([
            'message' => 'Successfully deleted User!'
        ], 201);
    }
    
}
