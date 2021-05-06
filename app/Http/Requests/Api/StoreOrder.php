<?php

namespace App\Http\Requests\Api;

use App\Repositories\TenantRepository;
use App\Services\OrderService;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!app(TenantRepository::class)->getTenantByUuid($this->segment(4))) {
            return false; // 404
        }
        
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
            'table' => [
                'nullable',
                'exists:tables,uuid',
            ],
            'comment' => [
                'nullable',
                'min:3',
                'max:1000',
            ],
            'products' => ['required'],
            'products.*.identify' => ['required','exists:products,uuid'],
            'products.*.qty' => ['required','integer']
        ];
    }
}
