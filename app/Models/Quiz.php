<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function quizquestion()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
