<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;

class Borda extends Model
{
    use HasFactory;
    protected $table = 'borda';

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
