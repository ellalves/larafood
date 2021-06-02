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
        return [
            'name' => ['required', 'min:3', 'max:255', "unique:tenants,name,{$id},id"],
            'email' => ['required', 'min:3', 'max:255', "unique:tenants,email,{$id},id"],
            'document' => ['required', "unique:tenants,document,{$id},id"],
            'logo' => ['nullable', 'image'],
            'plan_id' => ['required', 'numeric'],
            'active' => ['required', 'in:Y,N'],

            // // subscription
            // 'subscription' => ['nullable', 'date'],
            // 'expires_at' => ['nullable', 'date'],
            // 'subscription_id' => ['nullable', 'max:255'],
            // 'subscription_active' => ['required', 'boolean'],
            // 'subscription_suspended' => ['required', 'boolean'],
        ];
    }
}
