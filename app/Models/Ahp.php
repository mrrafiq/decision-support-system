<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DecisionMaker;
use App\Models\Category;

class Ahp extends Model
{
    use HasFactory;
    protected $table = "ahp";

    public function decision_maker()
    {
        return $this->belongsTo(DecisionMaker::class, 'foreign_key');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
