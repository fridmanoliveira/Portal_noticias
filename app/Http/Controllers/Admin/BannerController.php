<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\BannerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller
{
    protected BannerService $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        $banners = $this->bannerService->all();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(BannerRequest $request)
    {
        $this->bannerService->store($request->validated());

        return redirect()->route('admin.banners.index')->with('success', 'Banner criado com sucesso.');
    }

    public function edit(int $id)
    {
        $banner = $this->bannerService->find($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(BannerRequest $request, int $id)
    {
        $this->bannerService->update($id, $request->validated());

        return redirect()->route('admin.banners.index')->with('success', 'Banner atualizado com sucesso.');
    }

    public function destroy(int $id)
    {
        $this->bannerService->delete($id);
        return redirect()->route('admin.banners.index')->with('success', 'Banner excluído com sucesso.');
    }
}
