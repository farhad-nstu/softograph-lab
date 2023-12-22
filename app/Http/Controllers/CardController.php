<?php

namespace App\Http\Controllers;

use App\Interfaces\CardRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CardController extends Controller
{
    private $cardRepository;

    public function __construct(CardRepositoryInterface $cardRepository){
        $this->cardRepository = $cardRepository;
    }

    public function index(){
        try {
            $data = $this->cardRepository->index();
            return view('layouts.pages.cards', $data);
        } catch (\Exception $e) {
            Alert::error('Somthing is wrong!', $e->getMessage(), true);
            return redirect()->back();
        }
    }
}
