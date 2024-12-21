<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $guarded = ['id'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
