<?php

namespace App;

class Reply extends Model
{
    protected $fillable = ['content'];

    public function topic()
    {
        return $this->belongsTo(Topic::class)->with('category');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}