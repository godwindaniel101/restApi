<?php

namespace App\Http\Controllers\api;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function createProject(Request $request){
        $request->validate([
            'project_name' => 'required',
            'project_address' => 'required',
            'project_supervisor' => 'required',
            'project_description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $project = new Project([
            'user_id' =>auth('api')->user()->id,
            'company_id' => auth('api')->user()->company->id,
            'project_name' => $request->project_name,
            'project_address' => $request->project_address,
            'project_supervisor' => $request->project_supervisor,
            'ast_project_supervisor' => $request->ast_project_supervisor,
            'project_description' => $request->project_description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        $project->save();
        return response()->json(
            ['message'=>'Successfully created Project'], 201);
    }
    public function getProject(){
        $id =auth('api')->user()->company->id;
        $data = Project::Where('company_id', $id)->with('supervisor')->with('astsupervisor')->get();
        return response()->json(
            $data, 201);
    }
    public function getProjectRecord($id){
        $data = Project::where('id', $id)->first();
        return response()->json(
            $data, 201);
       }
    public function updateProject(Request $request,$id){
        $project = Project::where('id',$id);
        $project->update([
            'project_name' => $request->project_name,
            'project_address' => $request->project_address,
            'project_supervisor' => $request->project_supervisor,
            'ast_project_supervisor' => $request->ast_project_supervisor,
            'project_description' => $request->project_description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json([
            'message' => 'Successfully Updated Project!'
        ], 201);
    }
    public function deleteProject($id){
        // return $id;
        $data = Project::where('id', $id)->delete();
        return response()->json([
            'message' => 'Successfully deleted Project!'
        ], 201);
    }
}
