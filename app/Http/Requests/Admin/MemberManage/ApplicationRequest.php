<?php

namespace App\Http\Requests\Admin\MemberManage;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ApplicationRequest extends FormRequest
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
            'name' => 'required|alpha',
            'sex' => 'required',
            'email' => 'required|email',
            'class' => 'required|alpha_num',
            'self_introduce' => 'max:100'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail(422, '参数错误!', $validator->errors()->all(), 422)));
    }
}
