<?php

namespace App\Http\Requests\Admin;

use App\Rules\CardUniqueStatusName;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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

    public function rules()
    {
        $request = $this->all();  // all request value fetch
        return [
            'name'=> ['required', new CardUniqueStatusName($request['status'])],
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Please enter product name',
            'status.required'=>'Please choose a status',
        ];
    }
}
