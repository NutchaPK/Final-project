<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menunutrient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'calories',
        'protein',
        'potassium',
        'phosphorus',
        'sodium'
    ];
}
