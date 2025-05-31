<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
            $this->mergeWhen(isset($this->products), function () {
                return [
                    'products' => collect($this->products)
                        ->map(fn ($stock, $id) => ['id' => $id, 'stock' => $stock])
                        ->values(),
                ];
            }),
        ];
    }
}
