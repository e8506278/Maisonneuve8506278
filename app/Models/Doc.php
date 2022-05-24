<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre_en',
        'titre_fr',
        'user_id'
    ];

    public function docHasUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
