<?php

namespace App\Http\Controllers;

use App\Models\education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{
    //
    function getEducations(){
      $user = auth('sanctum')->user();
        if ($user) {
            return education::all()->where('user_id','==',$user->id);
        } else {
            return response(['message'=>'Unauthenticated'], 401, []);
        }
      }
}
