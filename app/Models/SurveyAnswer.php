<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class surveyAnswer extends Model
{
    use HasFactory;

    protected $table = 'surveyAnswer';
    protected $primaryKey = 'id';

    protected $fillable = ['surveyQuestionId', 'answer'];

    public function surveyQuestion(): BelongsTo
    {
        return $this->belongsTo(surveyQuestion::class);
    }
}
