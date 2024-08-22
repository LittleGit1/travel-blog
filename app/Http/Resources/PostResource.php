<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'          => 'post',
            'id'            => $this->id,
            'attributes'    => [
                'title' => $this->title,
                'slug'  => $this->slug,
                'body'  => $this->body,
                'createdAt' => $this->created_at,
                'featuredImage' => $this->featured_image_path,
            ],
            'relationships' => [
                'user'  => UserResource::collection($this->user)
            ]
        ];
    }
}
