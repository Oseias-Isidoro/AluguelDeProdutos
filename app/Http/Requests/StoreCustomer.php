<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * @property mixed $email
 * @property mixed $name
 * @property mixed $document
 * @property mixed $phone
 * @property mixed $street
 * @property mixed $zipcode
 * @property mixed $district
 * @property mixed $number
 * @property mixed $adjunct
 * @property mixed $city
 * @property mixed $state
 * @property mixed $country
 */
class StoreCustomer extends FormRequest
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
            'email' => 'email:rfc|unique:customers',
            'first_name' => 'required|string|',
            'last_name' => 'required|string|',
            'document' => 'required|unique:customers|string|digits:11',
            'phone_number' => 'required|string|digits:11'
        ];
    }

    protected function prepareForValidation()
    {
        $name = explode(" ", $this->name);

        $this->merge([
            'user_id' => Auth::user()->id,
            'first_name' => $name[0],
            'last_name' => $name[1] ?? '',
        ]);

        $this->request->remove('name');
    }
}
