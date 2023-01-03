<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ResponseApi;

    public function login(Request $request)
    {
        $data = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        dd($data);
    }
}
