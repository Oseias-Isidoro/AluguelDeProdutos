<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed $name
 * @property mixed $price
 * @property mixed $inventory
 */
class UpdateProduct extends FormRequest
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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'name' => 'required|string',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'inventory' => 'required|int'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['user_id' => Auth::user()->id]);

        if (isset($this->img))
            $this->merge(['img_path' => $this->img]);
    }
}
