<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Image;

class UserController extends Controller
{
    public function index(){
                
        //AllUser
        $user = User::get();
        if($user->isEmpty()){
            return response()->json([

                'status' => false,
                'message' => count($user) . ' Users Found',
    
            ] , 404);
            
        }
        return response()->json([

            'status' => true,
            'message' => count($user) . ' Users Found',
            'user data' => $user

        ] , 200);
    }

    public function showSingle($id){
        //SingleUser

        $user = User::find($id);
        if($user != null){

            return response()->json([
                
                'status' => true,
                'message' => 'User Found',
                'data' => $user

            ] , 200);
        }
        else{
            return response()->json([

                'status' => false,
                'message' => 'User Not Found',
                'data' => [],

            ] , 404);
        }
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'

        ]);
        if($validator->fails()){
            return response()->json([

                'status' => false,
                'message' => 'Fill All Fields',
                'errors' => $validator->errors(),

            ] , 404);
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response()->json([

            'status' => true,
            'message' => 'User Added Successfully',
            'data' => $user

        ] , 200);
    }

    public function update(Request $request , $id){

        $user = User::find($id);
        if($user == null){
            return response()->json([

                'status' => false,
                'message' => 'No User Found',
                'data' => [],

            ] , 404);
        }

        $validator = Validator::make($request->all() , [

            'name' => 'required',
            'email' => 'required|email|unique:users,email'

        ]);
        if($validator->fails()){
            return response()->json([

                'status' => false,
                'message' => 'Fill All Fields',
                'error' => $validator->errors()

            ] , 404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            
            'status' => true,
            'message' => 'User Updated Successfully',
            'data' => $user,

        ] , 200);

    }
    public function delete($id){

        $user = User::find($id);
        if($user == null){
            return response()->json([

                'status' => false,
                'message' => 'User Not Found',

            ] , 404);
        }

        $user->delete();

        return response()->json([

            'status' => true,
            'message' => 'User Deleted Successfully',

        ] , 200);
    }
    
}
