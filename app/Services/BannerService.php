<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    public function all(): \Illuminate\Support\Collection
    {
        return Banner::orderBy('ordem')->get();
    }

    public function find(int $id): Banner
    {
        return Banner::findOrFail($id);
    }

    public function store(array $data): Banner
    {
        try {
            if (isset($data['imagem']) && $data['imagem']->isValid()) {
                $imagem = $data['imagem'];
                $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                $imagem->move(public_path('banners'), $nomeImagem);
                $data['imagem'] = 'banners/' . $nomeImagem;
            }

            return Banner::create($data);
        } catch (\Exception $e) {
            if (isset($data['imagem'])) {
                Storage::disk('public')->delete($data['imagem']);
            }
            throw $e;
        }
    }

    public function update(int $id, array $data): Banner
    {
        $banner = $this->find($id);

        if (isset($data['imagem']) && $data['imagem']->isValid()) {
            if ($banner->imagem && file_exists(public_path($banner->imagem))) {
                unlink(public_path($banner->imagem));
            }

            $imagem = $data['imagem'];
            $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('banners'), $nomeImagem);
            $data['imagem'] = 'banners/' . $nomeImagem;
        } elseif (isset($data['remover_imagem']) && $data['remover_imagem']) {
            if ($banner->imagem && file_exists(public_path($banner->imagem))) {
                unlink(public_path($banner->imagem));
            }
            $data['imagem'] = null;
        } else {
            unset($data['imagem']);
        }

        $banner->update($data);
        return $banner;
    }

    public function delete(int $id): bool
    {
        $banner = $this->find($id);

        if ($banner->imagem && file_exists(public_path($banner->imagem))) {
            unlink(public_path($banner->imagem));
        }

        return $banner->delete();
    }
}
