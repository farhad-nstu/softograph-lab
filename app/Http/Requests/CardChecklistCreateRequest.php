<?php

namespace App\Http\Requests;

use App\Rules\ChecklistUniqueForCard;
use Illuminate\Foundation\Http\FormRequest;

class CardChecklistCreateRequest extends FormRequest
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
            'checklist_title' => ['required', new ChecklistUniqueForCard($request['card_no'], $request['checklist_id'])],
        ];
    }

    public function messages()
    {
        return [
            'card_no.required'=>'Please enter card title',
            'checklist_title.required'=>'Please choose file',
        ];
    }
}
