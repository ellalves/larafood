<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
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
        // $rules = config('lecturize.addresses.rules');

        return [
            'name' => 'required|min:3|max:60',
            'phone' => 'required|min:11|max:15|unique:clients',
            'email' => 'required|email|min:3|max:60|unique:clients',
            'document' => 'nullable|max:11|unique:clients,document',
            'password' => 'null|min:3|max:60',
            'address.street'       => 'required|string|min:3|max:60',
            'address.street_extra' => 'required|string|min:3|max:60',
            'address.city'         => 'required|string|min:3|max:60',
            'address.state'        => 'required|string|min:3|max:60',
            'address.post_code'    => 'required|min:4|max:10|AlphaDash',
            'address.country_id'   => 'required|integer',
        ];
    }
}
