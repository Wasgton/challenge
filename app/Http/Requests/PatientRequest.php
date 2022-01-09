<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "number"=>"required|numeric",
            "street"=>"nullable|min:3",
            "city"=>"nullable|min:3",
            "state"=>"nullable|min:3",
            "country"=>"nullable|min:3",
            "postcode"=>"nullable|min:3",
            "latitude"=>"nullable",
            "longitude"=>"nullable",
            "timezone"=>"nullable",
            "timezone_description"=>"nullable",
            "nat" =>"nullable",
            "title"=>"nullable|min:2|max:12",
            'first_name' => 'nullable|min:3',
            "last_name"=>"nullable|min:3",
            "gender" =>"nullable|min:3",
            "phone" =>"nullable|min:8",
            "cell" =>"nullable|min:8",
            "email" =>"nullable|min:11",
            "registered" =>"nullable",
            "uuid" =>"nullable|uuid",
            "username" =>"nullable",
            "dob" =>"nullable",
            "picture_large" =>"nullable",
            "picture_medium" =>"nullable",
            "picture_thumbnail" =>"nullable",
            "status" =>"nullable"
        ];
    }

}
