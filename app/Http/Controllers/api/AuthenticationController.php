<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Company;
use App\Employee;
use Carbon\Carbon;
use App\PasswordReset;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            'email' => 'required|unique:users|email:rfc,dns',
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
        $employee = new Employee([
            'user_id' => $user->id,
            'company_id' => $user->id,
            'first_name' => $request->company_name,
            'last_name' => 'default',
            'middle_name' => 'default',
            'date_of_birth' => 'default',
            'martial_status' => 'default',
            'sex' => '',
            'phone_no' => 'default',
            'alt_phone_no' => 'default',
            'email' => 'default',
            'department' => 'default',
            'position' => 'default',
            'salary' => 'default',
            'access_level' => 'default',
            'experience_years' => 'default',
            'employee_type' => 'default',
            'qualification' => 'default',
            'employee_type' => 'default',
            'start_date' => 'default',
            'country' => 'default',
            'state' => 'default',
            'city' => 'default',
        ]);
        $employee->save();
        // hellooooo
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
        if (!Auth::attempt($credentials)) {
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
        return response()->json(['data' => $request->user()], 201);
    }
    public function employee()
    {
        return auth('api')->user();
    }

    public function sendToken(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $checkuser_b = PasswordReset::where('email', $request->email);
        $checkuser = $checkuser_b->first();
        if (isset($checkuser->email)) {
            $checkuser_b->delete();
        }
        $user = User::where('email', $request->email)->first();
        if (!isset($user->id)) {
            return response()->json(['message' => 'invalid email'], 401);
        }
        $token = str_random(100);
        Mail::to($user)->send(new ResetPassword($token));
        $password = new PasswordReset([
            'email' => $user->email,
            'token' => $token,
        ]);
        $password->save();
        return response()->json(['message' => 'email sent'], 201);
    }
    //medium.com/graymatrix/using-gmail-smtp-server-to-send-email-in-laravel-91c0800f9662
    public function validateToken(Request $request)
    {
        // return($request->token);
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if (!isset($passwordReset->email)) {
            return response()->json(['message' => 'invalid token'], 401);
        }
        $user = User::where('email', $passwordReset->email)->first();
        return response()->json($user, 201);
    }
    public function resetPassword(Request $request)
    {
        $user = User::find($request->user_id);
        $passwordReset = PasswordReset::where('email', $user->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['message' => 'password changed'], 201);
    }
}
