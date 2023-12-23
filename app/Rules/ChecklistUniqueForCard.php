<?php

namespace App\Rules;

use App\Models\Checklist;
use Illuminate\Contracts\Validation\Rule;

class ChecklistUniqueForCard implements Rule
{
    protected $card_id;
    private $checklist_id;

    public function __construct($card_id, $checklist_id=null)
    {
        $this->card_id = $card_id;
        $this->checklist_id = $checklist_id;
    }

    public function passes($attribute, $value)
    {
        if($this->checklist_id){
            $checklists = Checklist::where([
                ['title', $value],
                ['card_id', $this->card_id]
            ])
            ->where('id', '<>', $this->checklist_id)
            ->get();
        } else{
            $checklists = Checklist::where([
                ['title', $value],
                ['card_id', $this->card_id]
            ])->get();
        }

        if ($checklists->count()) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'Checklist with this name of this card has already exist!';
    }
}
