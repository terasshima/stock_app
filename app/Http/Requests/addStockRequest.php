<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class addStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        if($this->path() == 'make/add'){
          return true;
        }else{
          return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
          'stock_code' => [
                'filled',
                'integer',
                'digits:4',
                'get_stock_price',
                Rule::unique('stocks')->where(function ($query) {
                  return $query->where('user_id', $this->user()->id); }),
              ],
          'company_name' => [
                'filled',
                'string',
                'max:50',
                Rule::unique('stocks')->where(function ($query) {
                  return $query->where('user_id', $this->user()->id); }),
              ],
          'holding_number' => [
                'filled',
                'integer',
                'min:1',
                'max:1000000000000'
              ],
          'average_price' => [
                'filled',
                'integer',
                'min:1',
                'max:1000000000000'
              ],
        ];
    }

    public function messages(){
      return [
        'stock_code.filled' => '入力してください！',
        'stock_code.integer' => '整数を(半角で)入力してください！',
        'stock_code.digits' => '4桁の数字を入力してください！',
        'stock_code.get_stock_price' => 'その証券コードは読み取れません！誤っているか、名証・札証・福証のいずれかに単独上場しています。',
        'stock_code.unique' => 'その証券コードは既に入力されています！',

        'company_name.filled' => '入力してください！',
        'company_name.string' => '文字を入力してください！',
        'company_name.max' => '入力文字数が多すぎます。50文字以内で入力してください！',
        'company_name.unique' => 'その銘柄名は既に入力されています！',

        'holding_number.filled' => '入力してください！',
        'holding_number.integer' => '整数を(半角で)入力してください！',
        'holding_number.min' => '1以上の数字を入力してください！',
        'holding_number.max' => '桁数が大きすぎます！',

        'average_price.filled' => '入力してください！',
        'average_price.integer' => '整数を(半角で)入力してください！',
        'average_price.min' => '1以上の数字を入力してください！',
        'average_price.max' => '桁数が大きすぎます！',
      ];
    }
}
