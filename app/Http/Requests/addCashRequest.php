<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addCashRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      if($this->path() == 'make/cash'){
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
    public function rules()
    {
        return [
          'cash' => 'filled|min:0|max:1000000000000|integer',
          'usersCash' => 'unique:bills,user_id'
        ];
    }

    public function messages(){
      return [
        'cash.filled' => '入力してください！',
        'cash.min' => '0以上の数字を入力してください！',
        'cash.max' => '桁数が大きすぎます！',
        'cash.integer' => '整数を(半角で)入力してください！',
        'usersCash.unique' => '既に現金(CP)は設定されています！'
      ];

    }
}
