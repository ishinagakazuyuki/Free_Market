<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressChangeRequest extends FormRequest
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
            'post_code' => 'required|between:7,7',
            'address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'post_code.required' => '郵便番号を入力してください',
            'post_code.between' => '郵便番号は7文字で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
