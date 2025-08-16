<?php

namespace App\Http\Controllers\admin;

use App\Models\Question;
use App\Models\FormAnswer;
use App\Models\PpaSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PPAController extends Controller
{
    public function showForm()
    {
        // Verificar se o formulário está aberto
        $settings = PpaSetting::first();

        if (!$settings || !$settings->isCurrentlyActive()) {
            return view('ppa.closed', [
                'message' => $settings->closed_message ?? 'O período de participação no PPA está encerrado.'
            ]);
        }

        // Restante do código original...
        $questions = Question::with('options')
            ->orderBy('order')
            ->get();

        $questionsBySection = $questions->groupBy('section');

        $districts = [
            'Centro', 'Vila Nova', 'Jardim das Flores', 'Bela Vista',
            'Santa Maria', 'Industrial', 'São José', 'Nova Esperança'
        ];

        return view('ppa.form', [
            'questionsBySection' => $questionsBySection,
            'districts' => $districts,
            'settings' => $settings
        ]);
    }

    public function submitForm(Request $request)
    {
        // Regras de validação
        $rules = [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|cpf',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'district' => 'required|string|max:255',
            'age_range' => 'required|string|max:10',
            'answers' => 'required|array',
            'terms' => 'required|accepted',
        ];

        // Mensagens personalizadas
        $messages = [
            'cpf.cpf' => 'O CPF informado é inválido.',
            'terms.required' => 'Você deve aceitar os termos para continuar.',
            'answers.required' => 'Por favor, responda todas as perguntas obrigatórias.',
        ];

        // Validação adicional para respostas
        $validator = Validator::make($request->all(), $rules, $messages);

        // Validar cada pergunta
        $questions = Question::with('options')->get();
        foreach ($questions as $question) {
            $validator->sometimes("answers.{$question->id}", 'required', function() use ($question) {
                return $question->is_required;
            });
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Criar a submissão
            $submission = FormSubmission::create([
                'name' => $request->name,
                'cpf' => $request->cpf,
                'email' => $request->email,
                'phone' => $request->phone,
                'district' => $request->district,
                'age_range' => $request->age_range,
                'suggestions' => $request->suggestions,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Processar respostas
            foreach ($request->answers as $questionId => $selectedOptions) {
                // Garantir que $selectedOptions seja sempre um array
                $selectedOptions = is_array($selectedOptions) ? $selectedOptions : [$selectedOptions];

                foreach ($selectedOptions as $optionId) {
                    $otherText = null;
                    if (strtolower(Question::find($questionId)->options->find($optionId)->option_text) === 'outro') {
                        $otherText = $request->input("other_answers.$questionId");
                    }

                    FormAnswer::create([
                        'form_submission_id' => $submission->id,
                        'question_id' => $questionId,
                        'question_option_id' => $optionId,
                        'other_text' => $otherText
                    ]);
                }
            }

            DB::commit();

            // Enviar email de confirmação (implementar depois)
            // Mail::to($submission->email)->send(new PPASubmissionConfirmation($submission));

            return redirect()->route('ppa.thanks', ['id' => $submission->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()
                ->back()
                ->with('error', 'Ocorreu um erro ao enviar seu formulário. Por favor, tente novamente.')
                ->withInput();
        }
    }

    public function showThanks($id)
    {
        $submission = FormSubmission::findOrFail($id);
        return view('ppa.thanks', compact('submission'));
    }

    public function dashboard()
    {
        $settings = PpaSetting::first();
        $totalPessoas = FormSubmission::count();

        $answersSummary = DB::table('form_answers')
            ->join('questions', 'form_answers.question_id', '=', 'questions.id')
            ->join('question_options', 'form_answers.question_option_id', '=', 'question_options.id')
            ->select(
                'questions.id as question_id',
                'questions.title as question_title',
                'question_options.id as option_id',
                'question_options.option_text',
                'form_answers.other_text',
                DB::raw('COUNT(DISTINCT form_answers.form_submission_id) as total_respostas'),
                DB::raw('ROUND(COUNT(DISTINCT form_answers.form_submission_id) * 100.0 / '.$totalPessoas.', 2) as percentage')
            )
            ->groupBy(
                'questions.id',
                'questions.title',
                'question_options.id',
                'question_options.option_text',
                'form_answers.other_text'
            )
            ->orderBy('questions.order')
            ->orderBy('question_options.order')
            ->get()
            ->groupBy('question_id');

        $demographics = [
            'districts' => FormSubmission::select('district', DB::raw('COUNT(*) as total'))
                ->groupBy('district')
                ->orderBy('total', 'desc')
                ->get(),

            'age_ranges' => FormSubmission::select('age_range', DB::raw('COUNT(*) as total'))
                ->groupBy('age_range')
                ->orderBy('age_range')
                ->get()
        ];
        $ultimaResposta = $totalPessoas > 0 ? FormSubmission::latest()->first() : null;

        return view('admin.ppa.dashboard', [
            'totalPessoas' => $totalPessoas,
            'data' => $answersSummary,
            'demographics' => $demographics,
            'ultimaResposta' => $ultimaResposta,
            'settings' => $settings
        ]);
    }
}
