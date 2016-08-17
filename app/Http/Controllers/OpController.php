<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use App\Player;
use Illuminate\Support\Collection;
class OpController extends Controller
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

    public function profile()
    {
      try{
        if($user=\JWTAuth::parseToken()->authenticate())
        {
          return $user;
        }
      }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['error'=>'token_expired'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['error'=>'token_invalid'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['error'=>'token_absent:'.$e->getMessage()], 500);

      }
    }
    //password UPDATE
    public function password(Request $request)
    {
      try{
        if($user=\JWTAuth::parseToken()->authenticate())
        {
          $user->password=Hash::make($request->password);
          if($user->push())
          {
            return response()->json(['message'=>'Successfully update password'], 200);
          }else{
            return response()->json(['error'=>'Fail to update password '], 500);
          }
        }
      }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['error'=>'token_expired'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['error'=>'token_invalid'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['error'=>'token_absent:'.$e->getMessage()], 500);

      }
    }
    //setting information
    public function settings()
    {
      try{
        if($user=\JWTAuth::parseToken()->authenticate())
        {
          if(!file_get_contents(__DIR__.'/../../../public/settings.json'))
          {
            return response()->json(['error'=>'Settting data not available'],500);
          }else{
            return json_decode(file_get_contents(__DIR__.'/../../../public/settings.json'),true);
          }
        }
      }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['error'=>'token_expired'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['error'=>'token_invalid'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['error'=>'token_absent:'.$e->getMessage()], 500);

      }
    }
    //ex user information
    public function users(Request $request)
    {
      try{
        if($user=\JWTAuth::parseToken()->authenticate())
        {
          return Player::where('opuser_id',$user->id)->paginate(10);
        }
      }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['error'=>'token_expired'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['error'=>'token_invalid'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['error'=>'token_absent:'.$e->getMessage()], 500);

      }
    }
    public function histroy(Request $request)
    {
      try{
        if($user=\JWTAuth::parseToken()->authenticate())
        {
          //histroy
          $players=Player::where('opuser_id',$user->id)->select('id')->get();
          //make $filter for opuser
          $filter='';
          if($request->has('username'))
          {
            $filter=$filter."username=$request->username";
          }
          if($request->has('betRange'))
          {
            $betRange=json_decode($request->input('betRange'));
            return $betRange->min;
          }


          //return gettype(json_encode($players));
          $client = new \GuzzleHttp\Client();
          $headers = ['Content-Type' => 'application/json'];

          $res = $client->request('POST', env('EX_PORT')."history?$filter",[
            //'players'=>[json_encode(json_decode($players,true))]
            'headers'=>$headers,
            'body'=>json_encode($players)
          ]);
          //$res=$res->getBody()->getContents();
          return $res;
          //return json_decode($players,true)[0]['id'];

        }
      }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['error'=>'token_expired'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['error'=>'token_invalid'], 500);

      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['error'=>'token_absent:'.$e->getMessage()], 500);

      }
    }
}
