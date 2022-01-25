<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // use HasFactory;
    protected $fillable = ['client_id', 'title', 'title', 'location', 'start_date', 'end_date'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
