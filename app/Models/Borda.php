<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;
use App\Models\DecisionSession;

class Borda extends Model
{
    use HasFactory;
    protected $table = 'borda';

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function session()
    {
        return $this->belongsTo(DecisionSession::class);
    }
}
