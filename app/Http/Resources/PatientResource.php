<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PatientResource extends JsonResource
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
            "title"=>$this->title,
            "name" => $this->first_name,
            "last_name"=>$this->last_name,
            "gender" => $this->gender,
            "phone" => $this->phone,
            "cell" => $this->cell,
            "email" => $this->email,
            "username" => $this->username,
            "street"=>$this->street,
            "city"=>$this->city,
            "sttate"=>$this->sttate,
            "postcode"=>$this->postcode,
            "latitude"=>$this->latitude,
            "longitude"=>$this->longitude,
            "timezone"=>$this->timezone,
            "timezone_description"=>$this->timezone_description,
            "nat" => $this->nat,
            "picture_large" => asset('storage').'/'.$this->picture_large,
            "picture_medium" => asset('storage').'/'.$this->picture_medium,
            "picture_thumbnail" => asset('storage').'/'.$this->picture_thumbnail,
            "registered" => $this->registered,
            "uuid" => $this->uuid,
            "dob" => $this->dob,
            "imported_t" => $this->imported_t,
            "updated_at" => $this->updated_at,
            "status" => $this->status,
        ];
    }
}
