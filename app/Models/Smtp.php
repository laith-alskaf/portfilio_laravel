<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class smtp extends Model
{
    use HasFactory;
    protected $fillable=[
        'code',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function personalInfos()
    {
      return  $this->belongsTo(User::class);
    }
}
