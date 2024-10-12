<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
   static public function sendMail(String $email,String $body)
    {
        // Mail::to($email)->send(new SendMail($body));
        Mail::raw( 'This code : '.$body . ' To Vierfy Email', function ($message)use ($email) {
            $message->to($email)
              ->subject('Vierfy Email');
          });
  
    }
}
