<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'day' => $this->day,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'user' => $this->User->name,
            'pharmacy' => $this->Pharmacy->name,
        ];
    }
}
