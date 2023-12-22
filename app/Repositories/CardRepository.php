<?php

namespace App\Repositories;

use App\Enums;
use App\Interfaces\CardRepositoryInterface;
use App\Models\Card;

class CardRepository implements CardRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function index(){
        $data['cards'] = Card::paginate(50);
        $data['statuses'] = Enums::CARD_STATUSES;
        $data['title'] = 'CARD LIST';
        return $data;
    }

    public function create(){
        $data['statuses'] = Enums::CARD_STATUSES;
        $data['title'] = 'CARD CREATE';
        return $data;
    }

    public function store($request){
        $card = Card::create($request);
        return $card;
    }

    public function edit(int $id){
        $data['statuses'] = Enums::CARD_STATUSES;
        $data['title'] = 'CARD EDIT';
        $data['card'] = Card::find($id);
        return $data;
    }

    public function update($request, int $id){
        $card = Card::where('id', $id)->update($request);
        return $card;
    }

    public function destroy(int $id){

    }
}
