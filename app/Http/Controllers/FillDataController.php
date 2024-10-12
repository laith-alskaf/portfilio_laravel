<?php

namespace App\Http\Controllers;

use App\Models\skill;
use App\Models\Contact;
use App\Models\Project;
use App\Models\education;
use App\Models\Certificate;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FillDataController extends Controller
{
    //
    public function saveFileJson(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'file' => 'required|file|mimes:json',
            'email' => 'required|email|exists:users',
        ]);
        if (!$validator->fails()) {
            $email = $request->email;
            $password = $request->password;
            $user = User::where('email', '=', $email)->first();
            if ($user->password == $password) {
                $destination = "public/download/";
                $nameFile = strstr($email, "@", true);
                $name = $nameFile . "." . $request->file->extension();
                $request->file->storeAs($destination, $name);
                return  $this->fillDataFromJsonFile($user);
            } else {
                return response(["message" => "Please input password and email valid"]);
            }
        } else {
            return response(["message" => "Please input fialds file and password"]);
        }
    }


    public function fillDataFromJsonFile($user)
    {
        $nameFile = strstr($user->email, "@", true);
        $records = Storage::json('/public/download/' . $nameFile . '.' . 'json');
        if ($records['personal_info'] != null) {
            $personalInfo =  $records['personal_info'];
            $personla = new PersonalInfo;
            $personla->user_id = $user->id;
            $personla->name = $personalInfo['name'];
            $personla->line = $personalInfo['line'];
            $personla->image = $personalInfo['image'];
            $personla->my_number = $personalInfo['my_number'];
            $personla->email = $personalInfo['email'];
            $personla->linkedIn = $personalInfo['linkedIn'];
            $personla->github = $personalInfo['github'];
            $personla->about_me = $personalInfo['about_me'];
            $personla->cv = $personalInfo['cv'];
            $personla->knowledge = json_encode($personalInfo['knowledge']);
            $personla->save();
        }
        if ($records['personal_info']['education'] != null) {
            foreach ($records['personal_info']['education'] as $education) {
                $educt = new education;
                $educt->title = $education['title'];
                $educt->user_id =  $user->id;
                $educt->body = $education['body'];
                $educt->university = $education['university'];
                $educt->date = $education['date'];
                $educt->save();
            }
        }
        if ($records['personal_info']['skills'] != null) {
            foreach ($records['personal_info']['skills'] as $skills) {
                $skill = new skill;
                $skill->user_id = $user->id;
                $skill->name = $skills['name'];
                $skill->percentage = $skills['percentage'];
                $skill->image = $skills['image'];
                $skill->save();
            }
        }
        if ($records['personal_info']['contactMe'] != null) {
            foreach ($records['personal_info']['contactMe'] as $contactMe) {
                $contact = new Contact;
                $contact->user_id = $user->id;
                $contact->image = $contactMe['image'];
                $contact->link = $contactMe['link'];
                $contact->save();
            }
        }
        if ($records['projects'] != null) {
            foreach ($records['projects'] as $proj) {
                $project = new Project;
                $project->user_id =  $user->id;
                $project->name = $proj['name'];
                $project->description = $proj['description'];
                $project->image = $proj['image'];
                $project->link = $proj['link'];
                $project->save();
            }
        }
        if ($records['certificates'] != null) {
            foreach ($records['certificates'] as $certificate) {
                $certif = new Certificate;
                $certif->name = $certificate['name'];
                $certif->user_id = $user->id;
                $certif->disc = $certificate['disc'];
                $certif->organization = $certificate['organization'];
                $certif->date = $certificate['date'];
                $certif->skills = $certificate['skills'];
                $certif->credential = $certificate['credential'];
                $certif->save();
            }
        }
        return Response(["message" => 'Fill data succesfully'], 200, []);
    }
}
