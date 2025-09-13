<?php

namespace App\Services;

use App\Http\Requests\MapaRequest;
use App\Models\Mapa;
use Illuminate\Support\Facades\File;

class MapaService
{
    public function getAll()
    {
        return Mapa::orderByDesc('created_at')->get();
    }

    public function findById(string $id)
    {
        return Mapa::findOrFail($id);
    }

    public function store(MapaRequest $request)
    {
        $data = $request->validated();
        $data['ativo'] = !empty($data['ativo']);

        if ($request->hasFile('arquivo_pdf')) {
            $pdfFile = $request->file('arquivo_pdf');
            $pdfName = uniqid('mapa_') . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path('storage/mapas/pdfs'), $pdfName);
            $data['arquivo_pdf'] = 'storage/mapas/pdfs/' . $pdfName;
        }

        return Mapa::create($data);
    }

    public function update(string $id, MapaRequest $request)
    {
        $mapa = $this->findById($id);
        $data = $request->validated();
        $data['ativo'] = !empty($data['ativo']);

        if ($request->hasFile('arquivo_pdf')) {
            if ($mapa->arquivo_pdf && File::exists(public_path($mapa->arquivo_pdf))) {
                File::delete(public_path($mapa->arquivo_pdf));
            }
            $pdfFile = $request->file('arquivo_pdf');
            $pdfName = uniqid('mapa_') . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path('storage/mapas/pdfs'), $pdfName);
            $data['arquivo_pdf'] = 'storage/mapas/pdfs/' . $pdfName;
        }

        $mapa->update($data);
        return $mapa;
    }

    public function delete(string $id)
    {
        $mapa = $this->findById($id);
        if ($mapa->arquivo_pdf && File::exists(public_path($mapa->arquivo_pdf))) {
            File::delete(public_path($mapa->arquivo_pdf));
        }
        return $mapa->delete();
    }
}
