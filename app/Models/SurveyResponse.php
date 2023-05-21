<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Survey;

class SurveyResponse extends Model
{
    use HasFactory;

    /**
     * Get Survey from SurveyResponse
     */
    public function survey(): \Illuminate\Database\Eloquent\Relations\HasOne {
        return $this->hasOne(Survey::class);
    }
}
