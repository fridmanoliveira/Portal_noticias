<?php

namespace App\Services;

use App\Models\VideoHome;
use Illuminate\Support\Facades\DB;
use App\Models\GalaeiriaImagesHistoria;

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
        try {
            $data['link_youtube'] = $this->formatarLinkEmbed($data['link_youtube']);

            $data['ativo'] = !empty($data['ativo']) ? true : false;
            if (!empty($data['ativo'])) {
                VideoHome::where('ativo', true)->update(['ativo' => false]);
            }

            $video = VideoHome::create($data);

            // Processa múltiplas imagens (galeria)
            if (request()->hasFile('imagens')) {
                foreach (request()->file('imagens') as $imagem) {
                    if ($imagem->isValid()) {
                        $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                        $imagem->move(public_path('videos'), $nomeImagem);

                        GalaeiriaImagesHistoria::create([
                            'video_id' => $video->id,
                            'image_path' => 'videos/' . $nomeImagem,
                        ]);
                    }
                }
            }

            return $video;
        } catch (\Exception $e) {
            // Em caso de erro, remove as imagens que já foram salvas
            if (isset($video)) {
                foreach ($video->imagens as $img) {
                    if (file_exists(public_path($img->image_path))) {
                        unlink(public_path($img->image_path));
                    }
                    $img->delete();
                }
                $video->delete(); // remove o vídeo também se falhou
            }

            throw $e;
        }
    }

    public function update(string $id, array $data): VideoHome
    {
        try {
            $video = VideoHome::findOrFail($id);

            // Formata o link do YouTube
            $data['link_youtube'] = $this->formatarLinkEmbed($data['link_youtube']);

            $data['ativo'] = !empty($data['ativo']) ? true : false;

            // Se marcado como ativo, desativa os demais
            if (!empty($data['ativo'])) {
                VideoHome::where('id', '!=', $id)->where('ativo', true)->update(['ativo' => false]);
            }

            // Atualiza os dados do vídeo
            $video->update($data);

            // Remove imagens selecionadas
            if (!empty($data['remover_imagens'])) {
                foreach ($data['remover_imagens'] as $imagemId) {
                    $imagem = GalaeiriaImagesHistoria::find($imagemId);
                    if ($imagem) {
                        if (file_exists(public_path($imagem->image_path))) {
                            unlink(public_path($imagem->image_path));
                        }
                        $imagem->delete();
                    }
                }
            }

            // Adiciona novas imagens
            if (request()->hasFile('imagens')) {
                foreach (request()->file('imagens') as $imagem) {
                    if ($imagem->isValid()) {
                        $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                        $imagem->move(public_path('videos'), $nomeImagem);

                        GalaeiriaImagesHistoria::create([
                            'video_id' => $video->id,
                            'image_path' => 'videos/' . $nomeImagem,
                        ]);
                    }
                }
            }

            return $video;
        } catch (\Exception $e) {
            throw $e;
        }
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
