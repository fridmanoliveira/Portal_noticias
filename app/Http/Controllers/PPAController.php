<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\FormAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PPAController extends Controller
{
    public function showForm()
    {
        $questions = \App\Models\Question::with('options')->get();
        return view('ppa.form', compact('questions'));
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'answers' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $submission = FormSubmission::create([
                'email' => $request->email
            ]);

            foreach ($request->answers as $questionId => $selectedOptions) {
                foreach ((array) $selectedOptions as $optionId) {
                    FormAnswer::create([
                        'form_submission_id' => $submission->id,
                        'question_id' => $questionId,
                        'option_id' => $optionId,
                        'other_text' => $request->input("other_answers.$questionId") // pode ser null
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Formulário enviado com sucesso!');
    }
public function dashboard()
{
    $data = DB::table('form_answers')
        ->join('questions', 'form_answers.question_id', '=', 'questions.id')
        ->leftJoin('question_options', 'form_answers.option_id', '=', 'question_options.id')
        ->select(
            'questions.id as question_id',
            'questions.title as question_title',
            'question_options.id as option_id',
            'question_options.option_text',
            'form_answers.other_text',
            DB::raw('COUNT(DISTINCT form_answers.form_submission_id) as total_respostas')
        )
        ->groupBy(
            'questions.id',
            'questions.title',
            'question_options.id',
            'question_options.option_text',
            'form_answers.other_text'
        )
        ->orderBy('questions.id')
        ->get()
        ->groupBy('question_id');

    // Total de pessoas que responderam o formulário (únicos)
    $totalPessoas = DB::table('form_submissions')->count();

    return view('admin.ppa.dashboard', compact('data', 'totalPessoas'));
}

}
