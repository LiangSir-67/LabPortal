<?php

namespace App\Http\Requests\Admin\PageContent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateGoodMemRequest extends FormRequest
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
            'member_id'=>'required|integer',
            'name'=>'required|max:18',
            'gm_bridf'=>'required',
            'priority'=>'required|between:1,3|integer',
            'member_url'=>'required'
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(\json_fail(422,'参数错误',$validator->errors()->all(),422)));
    }
}
