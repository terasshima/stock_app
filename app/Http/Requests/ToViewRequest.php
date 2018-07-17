<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToViewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      if($this->path() == 'view'){
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
          'principalToView' => 'exists:assets,principal|required',
          'stock_codeToView' => 'exists:stocks,stock_code|required',
          'cashToView' => 'exists:bills,cash|required'
        ];
    }

    public function messages(){
      return [
        'principalToView.required' => '投資元本は入力が必要です！',
        'stock_codeToView.required' => 'ポートフォリオに組み入れる銘柄を入力してください！',
        'cashToView.required' => '現金(CP)は入力が必要です！'
      ];
    }
}
