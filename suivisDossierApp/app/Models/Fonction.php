<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'created_by'
    ];

    public function personnels()
    {
        return $this->hasMany(Personnel::class);
    }
}
