<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgectsController extends Controller
{
    //
    function getProgects()
    {
        $user = auth('sanctum')->user();
        if ($user) {
            return Project::all()->where('user_id','==',$user->id);
        } else {
            return response(['message'=>'Unauthenticated'], 401, []);
        }
    }
    
  

    

}
