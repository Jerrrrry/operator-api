<?php

namespace App\Http\Controllers;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use \Illuminate\Http\Request;
class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function testjson()
    {
      $json=file_get_contents(__DIR__.'/../../../public/settings.json');
      return json_decode($json,true)['playform_setting']['percentage'];

    }

    //userjwt

    public function userjwt()
    {

      $user=User::find(1);
      $user->email="qybbqybb@gmail.com";
      if($user->push())
      {
        return "saved";
      }else{
        return 'not';
      }


    }

    public function headerjwt(Request $request)
    {
      if(\JWTAuth::invalidate(\JWTAuth::getToken()))
      {
        return 'logout';
      }else{
        return 'logout fail';
      }


    }

    //
}
