<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed $name
 */
class UpdateCustomer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'sometimes|email|unique:customers,email,'.$this->customer,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'document' => 'required|string|digits:11',
            'phone_number' => 'required|string|digits:11'
        ];
    }

    protected function prepareForValidation()
    {
        $name = explode(" ", $this->name);

        $data = $this->toArray();

        data_set($data, 'first_name',  $name[0]);
        data_set($data, 'last_name', $name[1] ?? '');

        $this->merge($data);

        $this->request->remove('name');
    }
}
