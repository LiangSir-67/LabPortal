<?php

namespace App\Http\Requests\Admin\PageContent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddContentToSqlRequest extends FormRequest
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
            'title'=>'required|string|max:30',
            'p_url'=>'required|string',
            'class_id'=>'required|integer|between:1,4',
            'priority'=>'required|integer|between:1,3',
            'neirong'=>'required'
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

