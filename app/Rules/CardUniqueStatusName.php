<?php

namespace App\Rules;

use App\Models\Card;
use Illuminate\Contracts\Validation\Rule;

class CardUniqueStatusName implements Rule
{
    protected $status;
    protected $card_id;

    public function __construct($status, $card_id=null)
    {
        $this->status = $status;
        $this->card_id = $card_id;
    }

    public function passes($attribute, $value)
    {
        if($this->card_id){
            $cards = Card::where([
                ['status', $this->status],
                ['name', $value]
            ])
            ->where('id', '<>', $this->card_id)
            ->get();
        } else{
            $cards = Card::where([
                ['status', $this->status],
                ['name', $value]
            ])->get();
        }

        if ($cards->count()) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'Product with this name of this category has already exist!';
    }
}
