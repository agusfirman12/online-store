<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
/**
 * @OA\Post(
 *    path="/api/register",
 *    tags={"Auth"},
 *    summary="register",
 *    description="enter your description",
 *    operationId="register",
 *    @OA\Response(
 *        response="default",
 *        description="return array model register",
 *    )
 * )
*/
    public function register(Request $request) {        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => $validator->errors(),
            ], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'User register successfully',
            'data' => $success,
        ]);
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;


            return response()->json([
                'success' => true,
                'message' => 'User login successfully',
                'data' => $success,
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Check your credentials',
                'data' => null,
            ]);
        }
    }
}
