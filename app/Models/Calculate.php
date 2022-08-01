<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;

class Calculate extends Model
{
    use HasFactory;

    public function decision_maker()
    {
        return $this->belongsTo(DecisionMaker::class, 'foreign_key');
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
