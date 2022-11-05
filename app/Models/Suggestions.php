<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestions extends Model
{
    use HasFactory;
    public $table = "suggestions";
    protected $fillable = [
        'user_id',
        'categories',
        'links',
        'observation',
        'group_id'
    ];
}
