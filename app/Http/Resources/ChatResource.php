<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ChatResource extends JsonResource
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
            'messages' => $this->message->content,
            'type' => $this->type,
            'read_at' => $this->read_at,
            'send_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
