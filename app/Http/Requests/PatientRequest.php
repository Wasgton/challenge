<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
            "number"=>"numeric",
            "street"=>"min:3",
            "city"=>"min:3",
            "state"=>"min:3",
            "country"=>"min:3",
            "postcode"=>"min:3",
            "timezone"=>"max:6",
            "timezone_description"=>"required_with:timezone",
            "title"=>"min:2|max:12",
            'first_name' => 'min:3',
            "last_name"=>"min:3",
            "gender" =>"min:3",
            "phone" =>"min:8",
            "cell" =>"min:8",
            "email" =>"min:11",
            "registered" =>"date_format:Y-m-d H:i:s",
            "uuid" =>"uuid",
            "username" =>"min:5",
            "dob" =>"date_format:Y-m-d H:i:s",
            "status" =>"in:draft,trash,published"
        ];
    }


}
