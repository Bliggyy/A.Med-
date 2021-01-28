<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'doc_id' => $this->doc_id,
          'lname' => $this->lname,
          'fname' => $this->fname,
          'specialization' => $this->specialization
        ];
    }
}
