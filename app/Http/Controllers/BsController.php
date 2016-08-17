<?php

namespace App\Http\Controllers;
use App\Player;
use Illuminate\Http\Request;

class BsController extends Controller
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

    public function user(Request $request)
    {
      //check player exist
      if($request->has('player'))
      {
        if($player=Player::find($request->input('player')))
        {
          return $player->created_at;
        }else{
          return 0;
        }
      }else{
        return 0;
      }


    }
    public function username($username)
    {
      //ron53
      if($user=Player::where('username',$username)->first())
      {
        return $user->id;
      }else{
        return 0;
      }
    }

    public function filter(Request $request)
    {
      //[
      //  ['status', '=', '1'],
      //  ['subscribed', '<>', '1'],
      //]
      //if($request->has('username'))
    }

    //
}
