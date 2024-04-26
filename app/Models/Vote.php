<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $table="votes";
    protected $fillable=[
        'contestant_id',
        'result',
        'rated_by',
        'updated_by',
    ];

    public static function getAllVote()
    {
        return self::all();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'rated_by');
    }

    public function contestant()
    {
        return $this->belongsTo(Contestant::class, 'contestant_id');
    }
}
