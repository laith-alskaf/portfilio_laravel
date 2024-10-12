<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable=[
        'image',
        'user_id',
        'link',
    ];
    public function personalInfos()
    {
      return  $this->belongsTo(PersonalInfo::class);
    }

}
