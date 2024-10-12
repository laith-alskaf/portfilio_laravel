<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'user_id',
        'disc',
        'organization',
        'date',
        'skills',
        'credential',
    ];
    public function personalInfos()
    {
      return  $this->belongsTo(PersonalInfo::class);
    }

}
