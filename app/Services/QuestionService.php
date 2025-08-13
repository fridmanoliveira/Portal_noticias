<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    public function getAllQuestions()
    {
        return Question::with('options')->orderBy('order')->get();
    }

    public function createQuestion(array $data): Question
    {
        return DB::transaction(function () use ($data) {
            $question = Question::create($this->extractQuestionFields($data));
            $this->syncOptions($question, $data['options']);
            return $question;
        });
    }

    public function updateQuestion(Question $question, array $data): Question
    {
        return DB::transaction(function () use ($question, $data) {
            $question->update($this->extractQuestionFields($data));
            $question->options()->delete();
            $this->syncOptions($question, $data['options']);
            return $question;
        });
    }

    public function deleteQuestion(Question $question): bool
    {
        return (bool) $question->delete();
    }

    private function syncOptions(Question $question, array $options): void
    {
        foreach ($options as $index => $option) {
            $question->options()->create([
                'option_text'     => $option,
                'order'           => $index,
                'has_other_field' => false,
            ]);
        }
    }

    private function extractQuestionFields(array $data): array
    {
        return collect($data)->only([
            'title',
            'description',
            'type',
            'order',
            'is_required',
            'section'
        ])->toArray();
    }
}
