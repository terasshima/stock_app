<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class addPrincipalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      if($this->path() == 'make/principal'){
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
          'principal' => 'filled|min:1|max:1000000000000|integer',
          'usersPrincipal' => 'unique:assets,user_id'
        ];
    }

    public function messages(){
      return [
        'principal.filled' => '入力してください！',
        'principal.min' => '1以上の数字を入力してください！',
        'principal.max' => '桁数が大きすぎます！',
        'principal.integer' => '整数を(半角で)入力してください！',
        'usersPrincipal.unique' => '既に投資元本は設定されています！'
      ];
    }
}
