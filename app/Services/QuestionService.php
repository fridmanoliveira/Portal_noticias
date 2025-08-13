<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    public function getAllQuestions()
    {
        return Question::with('options')->get();
    }

    public function createQuestion(array $data)
    {
        return DB::transaction(function () use ($data) {
            $question = Question::create([
                'title' => $data['title'],
                'type'  => $data['type']
            ]);

            foreach ($data['options'] as $option) {
                $question->options()->create([
                    'option_text' => $option
                ]);
            }

            return $question;
        });
    }

    public function updateQuestion(Question $question, array $data)
    {
        return DB::transaction(function () use ($question, $data) {
            $question->update([
                'title' => $data['title'],
                'type'  => $data['type']
            ]);

            $question->options()->delete();

            foreach ($data['options'] as $option) {
                $question->options()->create([
                    'option_text' => $option
                ]);
            }

            return $question;
        });
    }

    public function deleteQuestion(Question $question)
    {
        return $question->delete();
    }
}
