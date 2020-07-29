<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Company;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
       
      
        $request->validate([
            'company_name' => 'required|string',
            'email'=>'required|unique:users|email:rfc,dns',
            'phone_no' => 'required|numeric',
            'password' => 'required|string',
            'confirm_password' => 'same:password',
        ]);
        $user = new User([
            'name' => $request->company_name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'user_role' => '3',
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        $user->update([
            'company_id' => $user->id
        ]);


        $company = new Company([
            'id' => $user->id,
        ]);
        $company->save();


        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        // return $request;
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
           throw \Illuminate\Validation\ValidationException::withMessages([
            'invalidcombo' => ['invalid email/password combination'],
            ]);
        }
            // return response()->json([
            //     'message' => 'Unauthorized'
            // ], 422);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {

        return response()->json($request->user());
    }
    public function employee(){
        return auth('api')->user();
    }
}
