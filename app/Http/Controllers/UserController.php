<?php

namespace App\Http\Controllers;

use DateTimeZone;
use App\Models\smtp;
use App\Models\User;
use Nette\Utils\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public  static function validator(Request $request)
    {

        $data = $request->all();
        $valid = Validator::make($data, UserController::rule());
        if ($valid->fails()) {
            return response(['error' => $valid->errors(), 'Validation Error'], 400);
        } else {
            return UserController::createUser($request);
        }
    }

    static public  function rule()

    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }


    static public    function createUser(Request $request)
    {
        $user =   User::create([
            'name' => $request['name'],

            'email' => $request['email'],

            'password' => $request['password'],
        ]);

        $token = $user->createToken($user->name . '*' . now()->addWeek())->plainTextToken;
        return Response(["token" => $token]);
    }
    public function logout(Request $request)
    {
        $user = auth('sanctum')->user();
        $deleteUser = DB::table('users')->where('id', '=', $user->id)->delete();
        $request->user()->tokens()->delete();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        } else if ($deleteUser) {
            return response()->json(['message' => 'Done logout successfully'], 200);
        }
    }

    public function getUser()
    {

        $user = auth('sanctum')->user();
        if ($user) {
            return response($user, 200, []);
        } else {
            return response(['message' => 'Unauthenticated'], 401, []);
        }
    }
    public function resetPassword(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($data, [
            'newPassword' => 'required|string|min:6',
            'code' => 'required|integer|max_digits:5|min_digits:5|exists:smtps,code'
        ]);
        if ($valid->fails()) {
            return response(['error' => $valid->errors(), 'Validation Error'], 400);
        } else {
            $existCode = DB::select('select * from smtps where code =' . $request->code . '')[0];
            DB::table('users')->where('id', '=', $existCode->user_id)->update(['password' => $request->newPassword]);
            smtp::where('user_id', $existCode->user_id)->delete();
            return response(['message' => 'Done Reset Password'], 200, []);
        }
    }
    public function sendEmailCode(Request $request)
    {

        $data = $request->all();
        $valid = Validator::make($data, [
            'email' => 'required|email|exists:users,email'
        ]);
        if ($valid->fails()) {
            return response(['error' => $valid->errors(), 'Validation Error'], 400);
        } else {
            $email = $request->email;
            $idUser = User::all()->where('email', '=', $email)->first()->id;
            $existCode = DB::select('select * from smtps where user_id =' . $idUser . '');
            if (!$existCode) {
                $timeNow = (new DateTime('now', new DateTimeZone('Asia/Damascus')))->format('g');
                $code = random_int(10000, 99999);
                MailController::sendMail($email, $code);
                smtp::create([
                    'code' =>  $code,
                    'user_id' =>  $idUser,
                    'created_at' => $timeNow,
                    'updated_at' => $timeNow
                ]);
                return response(['message' => 'Done send code to email'], 200, []);
            } else {
                $newCode = random_int(10000, 99999);
                MailController::sendMail($email, $newCode);
                DB::table('smtps')->where('user_id', '=', $idUser)->update(['code' => $newCode]);
                return response(['message' => 'Done send code to email'], 200, []);
            }
        }
    }
    public function getHasMany($table)
    {
        return $this->hasMany($table::class, 'user_id');
    }
}
