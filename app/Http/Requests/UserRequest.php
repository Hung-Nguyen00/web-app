<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            switch ($this->method()) {
                case 'POST':
                    {
                        return [
                            'name' => 'required',
                            'email' => 'required|email|unique:users',
                            'password' => 'required'
                        ];
                    }
                case 'PUT':
                case 'PATCH':
                    {
                        return [
                                'name' => 'required',
                                'email' => "unique:users,email,$this->id,id",
            ];
        }
                default: break;
            }
    }
}
