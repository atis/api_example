<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Survey extends Model
{
    use HasFactory;

    /**
     * Get Questions from Survey
     */
    public function questions(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Question::class);
    }

    /**
     * Get array of Survey question IDs
     */
    public function question_ids(): array {
        $result = [];
        foreach ($this->questions()->get() as $v) {
            $result[$v->id] = $v->id;
        }
        return $result;
    }
}
