<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'user_id',
        'email',
        'line',
        'image',
        'my_number',
        'linkedIn',
        'github',
        'about_me',
        'cv',
        'knowledge',
    ];
  public function user()
    {
      return  $this->belongsTo(User::class,'user_id','id');
    }


}
