<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Services\QuestionService;

class AdminQuestionController extends Controller
{
    protected $service;

    public function __construct(QuestionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $questions = $this->service->getAllQuestions();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'type'    => 'required|in:checkbox,radio',
            'options' => 'required|array|min:1',
            'options.*' => 'required|string|max:255'
        ]);

        $this->service->createQuestion($request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Pergunta criada com sucesso!');
    }

    public function edit(Question $question)
    {
        $question->load('options');
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'type'    => 'required|in:checkbox,radio',
            'options' => 'required|array|min:1',
            'options.*' => 'required|string|max:255'
        ]);

        $this->service->updateQuestion($question, $request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Pergunta atualizada com sucesso!');
    }

    public function destroy(Question $question)
    {
        $this->service->deleteQuestion($question);

        return redirect()->route('admin.questions.index')->with('success', 'Pergunta removida com sucesso!');
    }

    
}
