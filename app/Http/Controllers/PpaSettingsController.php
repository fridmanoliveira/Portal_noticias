<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PpaSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PpaSettingsController extends Controller
{
    public function edit()
    {
        $settings = PpaSetting::firstOrNew();
        return view('admin.ppa.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $this->validateRequest($request);

        $settings = PpaSetting::updateOrCreate(
            ['id' => $request->id ?? null],
            $validated
        );

        return redirect()
            ->route('admin.ppa.dashboard')
            ->with('success', 'Configurações do PPA atualizadas com sucesso!');
    }

    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'sometimes|boolean',
            'closed_message' => 'nullable|string|max:500'
        ], [
            'start_date.before_or_equal' => 'A data de início deve ser anterior ou igual à data de término',
            'end_date.after_or_equal' => 'A data de término deve ser posterior ou igual à data de início'
        ]);
    }
}
