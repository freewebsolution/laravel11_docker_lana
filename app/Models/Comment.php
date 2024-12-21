<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Definisci la relazione inversa
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'post_id'); // post_id è la chiave esterna
    }
}
