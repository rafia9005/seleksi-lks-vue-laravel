<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
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
            'posisi' => $this->posisi,
            'nama' => $this->nama,
            'nomer_punggung' => $this->nomer_punggung,
            'created_by' => $this->whenLoaded('createdDetail'),
        ];
    }
}
