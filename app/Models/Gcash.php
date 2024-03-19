<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gcash extends Model
{
    use HasFactory;
    protected $table = '_gcash_jquery';
    protected $fillable = ['name', 'lastname', 'age', 'country'];
}
