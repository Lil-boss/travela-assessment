<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyEvent extends Model
{
    use HasFactory;

    protected $table = 'surveyEvent';
    protected $primaryKey = 'id';

    protected $fillable = ['surveyId', 'questionId', 'answerId'];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'surveyId');
    }

    public function surveyQuestion(): BelongsTo
    {
        return $this->belongsTo(SurveyQuestion::class, 'questionId');
    }

    public function surveyAnswer(): BelongsTo
    {
        return $this->belongsTo(SurveyAnswer::class, 'answerId');
    }
}
