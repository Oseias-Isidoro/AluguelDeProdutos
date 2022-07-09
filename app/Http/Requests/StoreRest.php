<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRest extends FormRequest
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
            'customer_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'lease_start_date' => 'required|date',
            'lease_end_date' => 'required|date',
            'cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'additional_charge' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'maintenance_cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'damage_rate' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    public function attributes()
    {
        return [
            'lease_start_date' => 'Inicio do Aluguel',
            'lease_end_date' => 'Fim do Aluguel',
            'cost' => 'Custo',
            'additional_charge' => 'Custo adicional',
            'maintenance_cost' => 'Custo de manuntenção',
            'damage_rate' => 'Taxa por danos',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo ":attribute" é obrigatorio',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id,
            'status' => 'in_progress'
        ]);
    }
}
