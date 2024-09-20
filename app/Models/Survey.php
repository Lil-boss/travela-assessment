<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'date'];

    public function surveyQuestion(): HasMany
    {
        return $this->hasMany(SurveyQuestion::class, 'surveyId');
    }

    public function surveyAnswer(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class, 'surveyId');
    }
}
