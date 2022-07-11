<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $hidden = [
        'id_user'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
