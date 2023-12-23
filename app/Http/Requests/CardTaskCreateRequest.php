<?php

namespace App\Http\Requests;

use App\Rules\TaskUniqueForCard;
use Illuminate\Foundation\Http\FormRequest;

class CardTaskCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $request = $this->all();
        return [
            'card_no'=> 'required',
            'task_title' => ['required', new TaskUniqueForCard($request['card_no'], $request['task_id'])],
        ];
    }

    public function messages()
    {
        return [
            'card_no.required'=>'Please enter card title',
            'task_title.required'=>'Please choose file',
        ];
    }
}
