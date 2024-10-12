<?php

namespace App\Http\Controllers;

use App\Models\skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use function Laravel\Prompts\error;

class SkillsController extends Controller
{
    //
    function getSkills()
    {
        $user = auth('sanctum')->user();
        if ($user) {
            return skill::all()->where('user_id', '==', $user->id);
        } else {
            return response(['message' => 'Unauthenticated'], 401, []);
        }
    }

    public  static function validator(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($data, SkillsController::rule());
        if ($valid->fails()) {
            return false;
        } else {
            return true;
        }
    }

    static   public  function rule()
    {
        return [
            'name' => 'required|string|max:255',
            'percentage' => 'required|max:100.0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }


    public    function createSkill(Request $request)
    {
        $user = auth('sanctum')->user();

        if ($user) {
            if (SkillsController::validator($request) == true) {
                $imageName = $request->name . '.' . $request->image->extension();
                $request->image->move(public_path('images/' . $user->name . '/'), $imageName);
                $user =   skill::create([
                    'name' => $request->name,
                    'user_id' => $user->id,
                    'percentage' => $request->percentage,
                    'image' => 'images/' . $user->name . '/' . $imageName,
                ]);
                return response(['status' => 'True'], 200, []);
            } else {
                return response(['message' => 'Please Input All field'], 401, []);
            }
        } else {
            return response(['message' => 'Unauthenticated'], 401, []);
        }
    }
}
