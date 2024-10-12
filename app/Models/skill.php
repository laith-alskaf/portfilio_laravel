<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skill extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'percentage',
        'user_id',
        'image',
    ];
    public function personalInfos()
    {
      return  $this->belongsTo(PersonalInfo::class);
    }
}
