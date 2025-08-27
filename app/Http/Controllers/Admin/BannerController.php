<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    protected BannerService $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index(): View
    {
        $banners = $this->bannerService->all();
        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banners.create');
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        $this->bannerService->store($request->validated());

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner criado com sucesso.');
    }

    public function edit(Banner $banner): View
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        $this->bannerService->update($banner, $request->validated());

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner atualizado com sucesso.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        $this->bannerService->delete($banner);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner excluído com sucesso.');
    }
}
