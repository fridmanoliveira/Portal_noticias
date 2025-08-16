<?php

namespace App\Http\Controllers\admin;

use App\Models\Question;
use App\Models\PpaSetting;
use App\Services\QuestionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;

class AdminQuestionController extends Controller
{
    protected QuestionService $service;

    public function __construct(QuestionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $questions = $this->service->getAllQuestions();
        return view('admin.questions.index', [
            'questions'=> $questions,
        ]);
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(QuestionRequest $request)
    {
        $this->service->createQuestion($request->validated());
        return redirect()
            ->route('admin.questions.index')
            ->with('success', 'Pergunta criada com sucesso!');
    }

    public function edit(Question $question)
    {
        $question->load('options');
        return view('admin.questions.edit', compact('question'));
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $this->service->updateQuestion($question, $request->validated());
        return redirect()
            ->route('admin.questions.index')
            ->with('success', 'Pergunta atualizada com sucesso!');
    }

    public function destroy(Question $question)
    {
        $this->service->deleteQuestion($question);
        return redirect()
            ->route('admin.questions.index')
            ->with('success', 'Pergunta removida com sucesso!');
    }
}
