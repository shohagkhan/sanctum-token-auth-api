<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function register(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'password' => 'required|confirmed'
        ]);
        // Create Data
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->phone_no = isset($request->phone_no) ? $request->phone_no : "";

        $student->save();

        // Return
        return response([
            'status' => 1,
            'message' => 'Student registration successfull'
        ]);
    }
    public function login(Request $request)
    {
        //Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Check student / user
        $student = Student::where('email', $request->email)->first();
        if (isset($student->id)) {
            //create token
            if (Hash::check($request->password, $student->password)) {

                $token = $student->createToken('auth_token')->plainTextToken;

                return response([
                    'status' => 1,
                    'message' => 'Student logged in successfully',
                    'access_token' => $token
                ]);
            } else {
                return response(['status' => 0, 'message' => 'Password didn\'t mathc'], 404);
            }
        } else {
            return response(['status' => 0, 'message' => 'Student not found'], 404);
        }
    }

    public function profile()
    {
        return response([
            'status' => 1,
            'message' => 'Student profile information',
            'data' => auth()->user()
        ]);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'status' => 1,
            'message' => 'Student logged out successfully'
        ]);
    }

    public function isLoggedIn() {
        $user = auth()->user();
        if (!isset($user)) {
            return response([
                'status'=>0,
                'message'=>'Not logged in'
            ]);
        }
        return response([ 'user'=>$user ]);
    }

}
