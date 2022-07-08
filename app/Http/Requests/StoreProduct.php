<?php

namespace App\Http\Requests;

use App\Services\ImageUploadService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * @property mixed $name
 * @property mixed $price
 * @property mixed $inventory
 */
class StoreProduct extends FormRequest
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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'inventory' => 'required|int'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id,
            'img_path' => $this->img
        ]);
    }

}
