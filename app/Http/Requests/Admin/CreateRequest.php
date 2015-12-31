<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

/**
 * Account CreateRequest.
 */
class CreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'  => 'required|max:255|min:2|unique:users',
            'email'    => 'required|email|unique:users',
            'password'     => 'required|min:6',
        ];
    }
}
