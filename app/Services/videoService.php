<?php

namespace App\Services;

use App\Models\VideoHome;
use Illuminate\Support\Facades\DB;

class VideoService
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return VideoHome::orderByDesc('created_at')->get();
    }

    public function findById(string $id): ?VideoHome
    {
        return VideoHome::findOrFail($id);
    }

    public function store(array $data): VideoHome
    {
        $data['link_youtube'] = $this->formatarLinkEmbed($data['link_youtube']);

        // Se o vídeo for marcado como ativo, desativa os demais
        if (!empty($data['ativo'])) {
            VideoHome::where('ativo', true)->update(['ativo' => false]);
        }

        return VideoHome::create($data);
    }


    public function update(string $id, array $data): VideoHome
    {
        $video = VideoHome::findOrFail($id);
        $data['link_youtube'] = $this->formatarLinkEmbed($data['link_youtube']);

        // Se o vídeo for marcado como ativo, desativa os demais
        if (!empty($data['ativo'])) {
            VideoHome::where('id', '!=', $id)->where('ativo', true)->update(['ativo' => false]);
        }

        $video->update($data);
        return $video;
    }


    public function delete(string $id): bool
    {
        $video = VideoHome::findOrFail($id);
        return $video->delete();
    }

    private function formatarLinkEmbed(string $url): string
    {
        // Caso seja um link youtu.be
        if (str_contains($url, 'youtu.be/')) {
            $videoId = substr(strrchr($url, '/'), 1);
            return "https://www.youtube.com/embed/{$videoId}";
        }

        // Caso seja um link com watch?v=
        if (str_contains($url, 'watch?v=')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            if (isset($params['v'])) {
                return "https://www.youtube.com/embed/{$params['v']}";
            }
        }
        // Se já estiver no formato embed ou for inválido, retorna como está
        return $url;
}

}
