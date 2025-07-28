<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\BannerRotativo;
use Illuminate\Support\Facades\Storage;

class BannerRotativoService
{
    public function store(array $data): BannerRotativo
    {
        if (isset($data['imagem'])) {
            $data['imagem'] = $data['imagem']->store('banners', 'public');
        }

        return BannerRotativo::create($data);
    }

    public function update(BannerRotativo $banner, array $data): BannerRotativo
    {
        if (isset($data['imagem'])) {
            if ($banner->imagem) {
                Storage::disk('public')->delete($banner->imagem);
            }
            $data['imagem'] = $data['imagem']->store('banners', 'public');
        }

        $banner->update($data);
        return $banner;
    }

    public function delete(BannerRotativo $banner): void
    {
        if ($banner->imagem) {
            Storage::disk('public')->delete($banner->imagem);
        }

        $banner->delete();
    }
}
