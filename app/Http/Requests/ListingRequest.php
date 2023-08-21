<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Created by this command : php artisan make:request Listing
     * @return bool
     */
    public function authorize()
    {
        // to be validated when user is authorized / logged in
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
            "title" => 'required',
            "company" => 'required|max:255|unique:listings,company,'. $this->id,
            "location" => 'required',
            "website" => 'required',
            "tags" => 'required',
            "description" => 'required',
            "email" => ['required', 'email'],
        ];

    }
}
