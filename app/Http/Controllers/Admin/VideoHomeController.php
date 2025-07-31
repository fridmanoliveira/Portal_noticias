<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Services\VideoService;

class VideoHomeController extends Controller
{
    protected $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function index()
    {
        $videos = $this->videoService->getAll();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(VideoRequest $request)
    {
        $this->videoService->store($request->validated());

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Vídeo cadastrado com sucesso.');
    }

    public function edit(string $id)
    {
        $video = $this->videoService->findById($id);
        return view('admin.videos.edit', compact('video'));
    }

    public function update(VideoRequest $request, string $id)
    {
        $this->videoService->update($id, $request->validated());

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Vídeo atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $this->videoService->delete($id);

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Vídeo removido com sucesso.');
    }
}
