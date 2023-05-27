<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CrawlerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'content' => $this->content,
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y'),
        ];
    }
}
