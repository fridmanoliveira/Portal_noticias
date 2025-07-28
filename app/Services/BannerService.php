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
        if (isset($data['imagem']) && $data['imagem']->isValid()) {
            $data['imagem'] = $data['imagem']->store('banners', 'public');
        }

        return Banner::create($data);
    }

    public function update(int $id, array $data): Banner
    {
        $banner = $this->find($id);

        if (isset($data['imagem']) && $data['imagem']->isValid()) {
            // Remove imagem antiga se necessário
            if ($banner->imagem && Storage::disk('public')->exists($banner->imagem)) {
                Storage::disk('public')->delete($banner->imagem);
            }

            $data['imagem'] = $data['imagem']->store('banners', 'public');
        }

        $banner->update($data);
        return $banner;
    }

    public function delete(int $id): bool
    {
        $banner = $this->find($id);

        if ($banner->imagem && Storage::disk('public')->exists($banner->imagem)) {
            Storage::disk('public')->delete($banner->imagem);
        }

        return $banner->delete();
    }
}
