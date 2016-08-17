<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'password' => 'required',
        ]);

        try {

            if (! $token = $this->jwt->attempt($request->only('name', 'password'))) {
                return response()->json(['error'=>'user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['error'=>'token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['error'=>'token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['error'=>'token_absent:'.$e->getMessage()], 500);

        }

        return response()->json(compact('token'));
    }

    public function logout()
    {
      try{
        if(\JWTAuth::invalidate(\JWTAuth::getToken()))
        {
          return response()->json(['success'=>'Logout Successfully'], 200);
        }
      }catch(\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e){
        return response()->json(['error'=>'Token alrealdy been blacklisted'], 500);
      }

    }
}
