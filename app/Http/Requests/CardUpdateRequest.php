<?php

namespace App\Http\Requests;

use App\Rules\CardUniqueStatusName;
use Illuminate\Foundation\Http\FormRequest;

class CardUpdateRequest extends FormRequest
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
        $request = $this->all();
        return [
            'name'=> ['required', new CardUniqueStatusName($request['status'], $request['card_id'])],
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Please enter card title',
            'status.required'=>'Please choose a status',
        ];
    }
}
