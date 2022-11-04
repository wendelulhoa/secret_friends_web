<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupsFriends extends Model
{
    use HasFactory;
    public $table = "groupsfriends";
    protected $fillable = [
        'name',
        'observation',
        'user_id'
    ];
}
