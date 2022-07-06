<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionMakerStatus extends Model
{
    use HasFactory;
    protected $table = 'decision_maker_status';

    public function decision_maker()
    {
        return $this->belongsTo(DecisionMaker::class, 'foreign_key');
    }
}
