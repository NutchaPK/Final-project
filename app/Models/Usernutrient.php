<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usernutrient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'calories',
        'protein',
        'potassium',
        'phosphorus',
        'sodium' 
    ];
}
