<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    //
    function getContacts(Request $request){
      $user = auth('sanctum')->user();
      if ($user) {
          return Contact::all()->where('user_id','==',$user->id);
      } else {
          return response(['message'=>'Unauthenticated'], 401, []);
      }
      }
}
