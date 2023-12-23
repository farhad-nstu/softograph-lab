<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardAttachmentCreateRequest;
use App\Http\Requests\CardChecklistCreateRequest;
use App\Http\Requests\CardCreateRequest;
use App\Http\Requests\CardTaskCreateRequest;
use App\Http\Requests\CardUpdateRequest;
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
    public function show($id){
        try {
            $data = $this->cardRepository->show($id);
            return view('layouts.pages.card_details', $data);
        } catch (\Exception $e) {
            Alert::error('Somthing is wrong!', $e->getMessage(), true);
            return redirect()->back();
        }
    }
    public function get_card_details(Request $request){
        $response = [];
        try {
            if(! $request->card_no){
                $response['message'] = 'Card name is required.';
                return response()->json($response, 422);
            }

            $data = $this->cardRepository->get_card_details($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store_card(CardCreateRequest $request){
        $response = [];
        try {
            $data = $this->cardRepository->store_card($request);

            if($data){
                // $response['data'] = $data;
                return view('layouts.pages.common.files.card_items', $data)->with('message', 'Data saved successfully');
                // return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update_card(CardUpdateRequest $request){
        $response = [];
        try {
            if(! $request->card_id){
                $response['message'] = 'Card id is required';
                return response()->json($response, 422);
            }

            $data = $this->cardRepository->update_card($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update_card_status(Request $request){
        try {
            $data = $this->cardRepository->update_card_status($request);
            if($data){
                return view('layouts.pages.common.files.card_items', $data)->with('message', 'Data status updated successfully');
                // return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store_card_attachment(CardAttachmentCreateRequest $request){
        $response = [];
        try {
            $data = $this->cardRepository->store_card_attachment($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store_card_checklist(CardChecklistCreateRequest $request){
        $response = [];
        try {
            $data = $this->cardRepository->store_card_checklist($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store_card_task(CardTaskCreateRequest $request){
        $response = [];
        try {
            $data = $this->cardRepository->store_card_task($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function get_checklist_details(Request $request){
        $response = [];
        try {
            if(! $request->checklist_id){
                $response['message'] = 'Checklist id is required.';
                return response()->json($response, 422);
            }

            $data = $this->cardRepository->get_checklist_details($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function get_task_details(Request $request){
        $response = [];
        try {
            if(! $request->task_id){
                $response['message'] = 'Task id is required.';
                return response()->json($response, 422);
            }

            $data = $this->cardRepository->get_task_details($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function remove_card_attachment(Request $request){
        $response = [];
        try {
            if(! $request->document_id){
                $response['message'] = 'Document id is required';
                return response()->json($response, 422);
            }

            $data = $this->cardRepository->remove_card_attachment($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function remove_card_checklist(Request $request){
        $response = [];
        try {
            if(! $request->checklist_id){
                $response['message'] = 'Checklist id is required';
                return response()->json($response, 422);
            }

            $data = $this->cardRepository->remove_card_checklist($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function remove_card_task(Request $request){
        $response = [];
        try {
            if(! $request->task_id){
                $response['message'] = 'Task id is required';
                return response()->json($response, 422);
            }

            $data = $this->cardRepository->remove_card_task($request);

            if($data){
                $response['data'] = $data;
                return response()->json($response, 200);
            }else{
                throw new \Exception('Not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
