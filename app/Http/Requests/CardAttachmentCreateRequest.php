<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardAttachmentCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'card_no'=> 'required',
            'card_documents' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'card_no.required'=>'Please enter card title',
            'card_documents.required'=>'Please choose file',
        ];
    }
}
