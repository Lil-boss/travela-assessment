<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class surveyQuestion extends Model
{
    use HasFactory;

    protected $table = 'surveyQuestion';
    protected $primaryKey = 'id';

    protected $fillable = ['surveyId', 'question'];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(survey::class);
    }
}
