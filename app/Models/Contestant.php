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
        'file_name',
        'created_by',
        'updated_by',
    ];
    
    public function votes()
    {
        return $this->hasMany(Vote::class, 'contestant_id');
    }

    public static function getAllContestant()
    {
        return self::withCount(['votes as yes_votes' => function ($query) {
            $query->where('result', 'Yes');
        }, 'votes as no_votes' => function ($query) {
            $query->where('result', 'No');
        }])->get();
    }
}
