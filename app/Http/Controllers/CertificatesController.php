<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificatesController extends Controller
{
    //
  function getCertificates(Request $request){
    $user = auth('sanctum')->user();
        if ($user) {
            return Certificate::all()->where('user_id','==',$user->id);
        } else {
            return response(['message'=>'Unauthenticated'], 401, []);
        }
  }
}
