<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configsstake extends Model
{
    use HasFactory;

    public $table = "configsstake";
    protected $fillable = [
        'user_id_selected',
        'mines',
        'plays'
    ];
}
