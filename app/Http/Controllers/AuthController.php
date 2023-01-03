<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseApi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ResponseApi;

    public function login(Request $request)
    {
        try {
            
            $data = Validator::make($request->all(), [
                'username' => 'required|email',
                'password' => 'required'
            ]);

            if($data->fails()) {
                return $this->error($data->errors(), 400);
            }

            $user = User::where('username', $request->username)->first();

            if(!$user) {
                return $this->error('user not found', 404);
            }

            if(!Auth::attempt($request->only(['username', 'password']))) {
                return $this->error('email or password doesn\'t match');
            }

            $token = $user->createToken('th!sT0k3n')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login successfully.',
                'data' => [
                    'name' => $user->name,
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]
            ]);


        } catch (Exception $e) {

            return $this->error($e->getMessage(), 500);

        }

        
    }
}
