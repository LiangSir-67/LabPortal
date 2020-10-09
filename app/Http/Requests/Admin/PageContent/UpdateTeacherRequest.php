<?php

namespace App\Http\Requests\Admin\PageContent;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTeacherRequest extends FormRequest
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
            'id'=>'required|integer',
            'name'=>'required|max:18',
            'priority'=>'required|integer|between:1,3',
            't_url'=>'required',
            't_bridf'=>'required',
            'profession'=>'required|max:18'
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
