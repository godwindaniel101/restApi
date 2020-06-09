<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::all();
        if($data){
            $response['status'] = true;
            $response['message'] = 'Data Successfully recovered';
            $response['data'] = $data;
        }else{
            $response['status'] = false;
            $response['message'] = 'Data could not be recovered';
            $response['data'] = ' ';
        }
    return json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = Employee::create([
            'first_name' =>$request->input('first_name'),
            'last_name' =>$request->input('last_name'),
            'email' =>$request->input('email'),
            'phone_no' =>$request->input('phone_no'),
            'position' =>$request->input('position'),
            'salary' =>$request->input('salary'),
            'type' =>$request->input('type'),
            'status' =>$request->input('status'),
            'duration' =>$request->input('duration'),
        ]);
     if($data){
            $response['status'] = true;
            $response['message'] = 'Employee Created';
        }else{
            $response['status'] = false;
            $response['message'] = 'Employee could not be created';
        }
    return json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Employee::where('id', $id)->first();
        if($data){
            $response['status'] = true;
            $response['message'] = 'Data Successfully recovered';
            $response['data'] = $data;
        }else{
            $response['status'] = false;
            $response['message'] = 'Data could not be recovered';
            $response['data'] = ' ';
        }
        return json_encode($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Employee::where('id', $id)->first();
        if($data){
            $response['status'] = true;
            $response['message'] = 'Data Successfully recovered';
            $response['data'] = $data;
        }else{
            $response['status'] = false;
            $response['message'] = 'Data could not be recovered';
            $response['data'] = ' ';
        }
        return json_encode($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Employee::where('id', $id)->update([
            'first_name' =>$request->input('first_name'),
            'last_name' =>$request->input('last_name'),
            'email' =>$request->input('email'),
            'phone_no' =>$request->input('phone_no'),
            'position' =>$request->input('position'),
            'salary' =>$request->input('salary'),
            'type' =>$request->input('type'),
            'status' =>$request->input('status'),
            'duration' =>$request->input('duration'),
        ]);
        if($data){
            $response['status'] = true;
            $response['message'] = 'Data Successfully updated';
            $response['data'] = $data;
        }else{
            $response['status'] = false;
            $response['message'] = 'Data could not be updated';
            $response['data'] = ' ';
        }
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Employee::where('id' , $id)->delete();
        if($data){
            $response['status'] = true;
            $response['message'] = 'Data Successfully deleted';
            $response['data'] = $data;
        }else{
            $response['status'] = false;
            $response['message'] = 'Data could not be deleted';
            $response['data'] = ' ';
        }
        return json_encode($response);
    }
}
