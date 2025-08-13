<?php

namespace App\Services;

use App\Models\Turismo;
use Illuminate\Support\Facades\DB;
use App\Models\GalaleiriaImagesTurismo;

class TurismoService
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Turismo::orderByDesc('created_at')->get();
    }

    public function findById(string $id): ?Turismo
    {
        return Turismo::findOrFail($id);
    }

    public function store(array $data): Turismo
    {
        try {
            // Define ativo como booleano, false se não vier
            $data['ativo'] = !empty($data['ativo']) ? true : false;

            if ($data['ativo']) {
                Turismo::where('ativo', true)->update(['ativo' => false]);
            }
            if (request()->hasFile('pdf')) {
                $pdfFile = request()->file('pdf');
                $pdfName = uniqid() . '.' . $pdfFile->getClientOriginalExtension();
                $pdfFile->move(public_path('turismo/pdfs'), $pdfName);
                $data['pdf'] = 'turismo/pdfs/' . $pdfName;
            }

            $turismo = Turismo::create($data);

            // Processa múltiplas imagens (galeria)
            if (request()->hasFile('imagens')) {
                foreach (request()->file('imagens') as $imagem) {
                    if ($imagem->isValid()) {
                        $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                        $imagem->move(public_path('turismo'), $nomeImagem);

                        GalaleiriaImagesTurismo::create([
                            'turismo_id' => $turismo->id,
                            'image_path' => 'turismo/' . $nomeImagem,
                        ]);
                    }
                }
            }

            return $turismo;
        } catch (\Exception $e) {
            if (isset($turismo)) {
                foreach ($turismo->imagens as $img) {
                    if (file_exists(public_path($img->image_path))) {
                        unlink(public_path($img->image_path));
                    }
                    $img->delete();
                }
                $turismo->delete();
            }

            throw $e;
        }
    }

    public function update(string $id, array $data): Turismo
    {
        try {
            $turismo = Turismo::findOrFail($id);

            $data['ativo'] = !empty($data['ativo']) ? true : false;

            if ($data['ativo']) {
                Turismo::where('id', '!=', $id)->where('ativo', true)->update(['ativo' => false]);
            }
            if (request()->hasFile('pdf')) {
                // Apaga o PDF antigo
                if ($turismo->pdf && file_exists(public_path($turismo->pdf))) {
                    unlink(public_path($turismo->pdf));
                }

                $pdfFile = request()->file('pdf');
                $pdfName = uniqid() . '.' . $pdfFile->getClientOriginalExtension();
                $pdfFile->move(public_path('turismo/pdfs'), $pdfName);
                $data['pdf'] = 'turismo/pdfs/' . $pdfName;
            }


            $turismo->update($data);

            // Remove imagens selecionadas
            if (!empty($data['remover_imagens'])) {
                foreach ($data['remover_imagens'] as $imagemId) {
                    $imagem = GalaleiriaImagesTurismo::find($imagemId);
                    if ($imagem) {
                        if (file_exists(public_path($imagem->image_path))) {
                            unlink(public_path($imagem->image_path));
                        }
                        $imagem->delete();
                    }
                }
            }

            // Adiciona novas imagens
            if (request()->hasFile('imagens')) {
                foreach (request()->file('imagens') as $imagem) {
                    if ($imagem->isValid()) {
                        $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                        $imagem->move(public_path('videos'), $nomeImagem);

                        GalaleiriaImagesTurismo::create([
                            'turismo_id' => $turismo->id,
                            'image_path' => 'videos/' . $nomeImagem,
                        ]);
                    }
                }
            }

            return $turismo;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete(string $id): bool
    {
        $turismo = Turismo::findOrFail($id);
        return $turismo->delete();
    }

}
