<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormAnswer extends Model
{
    protected $fillable = ['form_submission_id', 'question_id', 'option_id', 'other_text'];

    public function submission()
    {
        return $this->belongsTo(FormSubmission::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(QuestionOption::class);
    }
}
