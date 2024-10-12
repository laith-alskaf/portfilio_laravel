<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalInfoController extends Controller
{
    //
    function getPersonalInfo(Request $request){
      $user = auth('sanctum')->user();
      if ($user) {
          return PersonalInfo::all()->where('user_id','==',$user->id);
      } else {
          return response(['message'=>'Unauthenticated'], 401, []);
      }
      }
}
