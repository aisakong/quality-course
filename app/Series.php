<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
        'title', 'introduction',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
