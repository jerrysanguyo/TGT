<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;
    protected $table="contestants";
    protected $fillable=[
        'name',
        'talent',
        'created_by',
        'updated_by',
    ];

    public static function getAllContestant()
    {
        return self::all();
    }
}
