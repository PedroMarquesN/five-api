<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'caminho' => $this->caminho,
            'status' => $this->status,
            'user' => new UserResource($this->user),
            'aprovado_por' => new UserResource($this->aprovadoPor),
        ];
    }
}
