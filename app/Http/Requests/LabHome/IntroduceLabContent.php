<?php

namespace App\Http\Requests\LabHome;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class IntroduceLabContent extends FormRequest
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
            'title'=>'required|max:29'
            //
        ];
    }

    /**
     * @param Validator $validator
     */
    protected  function failedValidation(Validator $validator)
    {
        throw (new HttpRequestException(\json_fail(422 , '参数错误' , $validator->errors()->all(),422)));
    }
}
