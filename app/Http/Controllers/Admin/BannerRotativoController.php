<?php

namespace App\Http\Controllers\Admin;

use App\Models\BannerRotativo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRotativoRequest;
use App\Services\BannerRotativoService;

class BannerRotativoController extends Controller
{
    public function __construct(protected BannerRotativoService $service) {}

    public function index()
    {
        $banners = BannerRotativo::orderBy('ordem')->get();
        return view('admin.banners-rotativo.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners-rotativo.create');
    }

    public function store(BannerRotativoRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.banners-rotativo.index')->with('success', 'Banner criado com sucesso.');
    }

    public function edit(BannerRotativo $bannerRotativo)
    {
        return view('admin.banners-rotativo.edit', ['banner' => $bannerRotativo]);
    }

    public function update(BannerRotativoRequest $request, BannerRotativo $bannerRotativo)
    {
        $this->service->update($bannerRotativo, $request->validated());
        return redirect()->route('admin.banners-rotativo.index')->with('success', 'Banner atualizado com sucesso.');
    }

    public function destroy(BannerRotativo $bannerRotativo)
    {
        $this->service->delete($bannerRotativo);
        return back()->with('success', 'Banner excluído com sucesso.');
    }
}
