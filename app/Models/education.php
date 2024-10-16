<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'body',
        'user_id',
        'university',
        'date',
    ];
    public function personalInfos()
    {
      return  $this->belongsTo(PersonalInfo::class);
    }
}
