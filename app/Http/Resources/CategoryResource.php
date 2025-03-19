<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'url' => $this->url,
            'path' => $this->path,
            'items' => $this->when($this->models->isNotEmpty(), function () {
                return new ProductCollection($this->models);
            }, null),
        ];
    }
}
