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

    public function edit(BannerRotativo $banners_rotativo)
    {
        return view('admin.banners-rotativo.edit', compact('banners_rotativo'));
    }

    public function update(BannerRotativoRequest $request, BannerRotativo $banners_rotativo)
    {
        $this->service->update($banners_rotativo, $request->validated());
        return redirect()->route('admin.banners-rotativo.index')->with('success', 'Banner atualizado com sucesso.');
    }

    public function destroy(BannerRotativo $banners_rotativo)
    {
        $this->service->delete($banners_rotativo);
        return back()->with('success', 'Banner excluído com sucesso.');
    }
}
