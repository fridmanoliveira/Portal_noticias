<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Http\UploadedFile;

class BannerService
{
    protected string $path = 'banners';

    /**
     * Retorna todos os banners ordenados pela ordem.
     */
    public function all()
    {
        return Banner::orderBy('ordem')->get();
    }

    /**
     * Encontra um banner pelo ID.
     */
    public function find(int $id): Banner
    {
        return Banner::findOrFail($id);
    }

    /**
     * Cria um novo banner.
     */
    public function store(array $data): Banner
    {
        // Processa a imagem se for enviada
        if (isset($data['imagem']) && $data['imagem'] instanceof UploadedFile && $data['imagem']->isValid()) {
            $data['imagem'] = $this->saveImage($data['imagem']);
        }

        return Banner::create($data);
    }

    /**
     * Atualiza um banner existente.
     */
    public function update(Banner $banner, array $data): Banner
    {
        // Substitui a imagem se for enviada
        if (isset($data['imagem']) && $data['imagem'] instanceof UploadedFile && $data['imagem']->isValid()) {
            $this->deleteImage($banner->imagem);
            $data['imagem'] = $this->saveImage($data['imagem']);
        }
        // Remove a imagem se solicitado
        elseif (!empty($data['remover_imagem'])) {
            $this->deleteImage($banner->imagem);
            $data['imagem'] = null;
        }
        else {
            unset($data['imagem']);
        }

        $banner->update($data);
        return $banner;
    }

    /**
     * Exclui um banner e sua imagem.
     */
    public function delete(Banner $banner): bool
    {
        $this->deleteImage($banner->imagem);
        return $banner->delete();
    }

    /**
     * Salva a imagem no diretório público e retorna o caminho.
     */
    protected function saveImage(UploadedFile $file): string
    {
        $nomeImagem = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($this->path), $nomeImagem);
        return $this->path . '/' . $nomeImagem;
    }

    /**
     * Deleta a imagem do banner, se existir.
     */
    protected function deleteImage(?string $filePath): void
    {
        if ($filePath) {
            $fullPath = public_path($filePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
