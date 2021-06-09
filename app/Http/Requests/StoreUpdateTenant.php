<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTenant extends FormRequest
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
        $id = $this->segment(3);

        if ($this->method() == 'PUT') {
            $rules = [
                'email' => ['required', 'min:3', 'max:255', "unique:tenants,email,{$id},id"],
                'document' => ['required', "unique:tenants,document,{$id},id"],
                'logo' => ['nullable', 'image'],
                'bio' => ['required', 'min:3', 'max:1000'],
                'active' => ['required', 'in:Y,N'],
            ];
        } else {
            $rules =  [
                'name' => ['required', 'min:3', 'max:255', "unique:tenants,name,{$id},id"],
                'email' => ['required', 'min:3', 'max:255', "unique:tenants,email,{$id},id"],
                'document' => ['required', "unique:tenants,document,{$id},id"],
                'logo' => ['required', 'image'],
                'plan_id' => ['required', 'numeric'],
                'active' => ['required', 'in:Y,N'],
    
            ];
        }

        return $rules;
    }
}
