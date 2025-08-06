<?php

namespace App\Services;

use App\Models\BannerRotativo;
use Illuminate\Support\Facades\Storage;

class BannerRotativoService
{
    public function store(array $data): BannerRotativo
    {
        try {
            if (isset($data['imagem']) && $data['imagem']->isValid()) {
                $imagem = $data['imagem'];
                $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                $imagem->move(public_path('banners'), $nomeImagem);
                $data['imagem'] = 'banners/' . $nomeImagem;
            }

            return BannerRotativo::create($data);
        } catch (\Exception $e) {
            if (isset($data['imagem'])) {
                Storage::disk('public')->delete($data['imagem']);
            }
            throw $e;
        }
    }

    public function update(BannerRotativo $banner, array $data): BannerRotativo
    {
        if (isset($data['imagem']) && $data['imagem']->isValid()) {
            // Remove imagem antiga
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

    public function delete(BannerRotativo $banner): void
    {
        if ($banner->imagem && file_exists(public_path($banner->imagem))) {
            unlink(public_path($banner->imagem));
        }

        $banner->delete();
    }
}
