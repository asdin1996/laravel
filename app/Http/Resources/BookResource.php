<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'contact' => $this->contact ? [
                'id' => $this->contact->id,
                'name' => $this->contact->name,
                'email' => $this->contact->email,
                'file' => $this->contact->file,
            ] : null,
        ];

    }
}
