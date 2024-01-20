<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'category' => 'required',
            'new_first' => 'required_if:category,another',
            'new_second' => 'required_if:category,another',
            'condition' => 'required',
            'new_condition' => 'required_if:condition,another',
            'name' => 'required',
            'brand' => 'required',
            'new_brand' => 'required_if:brand,another',
            'description' => 'required',
            'value' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'image.required' => '商品の画像を選択してください',
            'image.mimes' => '画像の形式は"jpeg,png,jpg,gif"をアップロードしてください',
            'category.required' => '該当するカテゴリーを選択してください',
            'new_first.required_if' => '出品する商品に適したカテゴリ（種類）を入力してください',
            'new_second.required_if' => '出品する商品に適したカテゴリ（用途）を入力してください',
            'condition.required' => '該当する状態を選択してください',
            'new_condition.required_if' => '出品する商品に適した状態を入力してください',
            'name.required' => '商品名を入力してください',
            'brand.required' => '該当するブランドを選択してください',
            'new_brand.required_if' => '出品する商品に適したブランドを入力してください',
            'description.required' => '商品の説明を入力してください',
            'value.required' => '販売価格を入力してください',
            'value.integer' => '販売価格は半角数字で入力してください',
        ];
    }
}
