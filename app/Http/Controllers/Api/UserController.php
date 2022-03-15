<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Controllers\GeneralController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function auth;

class UserController extends GeneralController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->errorResponse( $validator->messages()->first() , (object)[], 401);
        }
        $credentials = $request->only(['email', 'password']);
        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return $this->errorResponse( __('lang.login_data_not_correct') , (object)[], 401);
        }
        $user = Auth::guard('api')->user();
        if (!$token) {
            return $this->errorResponse( __('lang.login_data_not_correct') , (object)[], 401);
        }

        $user_data = User::where('id', $user->id)->first();
        $user_data->token_api = $token;
        return $this->sendResponse($user_data, 'تم تسجيل الدحول بنجاح', 200);
    }


    public function logout()
    {
        auth('api')->logout();
        return $this->sendResponse(null, 'تم تسجيل الخروج بنجاح', 200);
    }



}
