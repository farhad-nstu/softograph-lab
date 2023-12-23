<?php

namespace App\Repositories;

use App\Enums;
use App\Interfaces\CardRepositoryInterface;
use App\Models\Card;
use App\Models\CardAttachment;
use App\Models\CardTask;
use App\Models\Checklist;
use App\Traits\DocumentTrait;

class CardRepository implements CardRepositoryInterface
{
    use DocumentTrait;

    public function __construct()
    {
        //
    }

    public function index(){
        $data['cards'] = Card::all();
        $data['statuses'] = Enums::CARD_STATUSES;
        $data['title'] = 'CARD LIST';
        return $data;
    }

    public function show(int $id){
        $data['statuses'] = Enums::CARD_STATUSES;
        $data['title'] = 'CARD DETAILS';
        $data['card'] = Card::find($id);
        return $data;
    }

    public function get_card_details($request){
        $card = Card::with(['card_attachments', 'card_checklists', 'card_tasks'])->where('id', $request->card_no)->first();
        return $card;
    }

    public function store_card($request){
        $requestedData = $request->except('_token');
        $card = Card::create($requestedData);
        if($card){
            $data['message'] = 'Card data saved successfully';
            $data['cards'] = Card::all();
            $data['statuses'] = Enums::CARD_STATUSES;
            return $data;
        }
        return false;
    }

    public function update_card($request){
        $requestedData = $request->except('_token', 'card_id');
        $card = Card::where('id', $request->card_id)->update($requestedData);
        if($card){
            $data['card'] = Card::find($request->card_id);
            $data['message'] = 'Card updated successfully';
            return $data;
        }
        return false;
    }

    public function update_card_status($request){
        $target_div_card_status = Card::where('id', $request->target_status_div)->pluck('status')->first();
        $card = Card::find($request->card_id);
        $card->status = $target_div_card_status;
        if($card->update()){
            $data['message'] = 'Card status updated successfully';
            $data['cards'] = Card::all();
            $data['statuses'] = Enums::CARD_STATUSES;
            return $data;
        }
        return false;
    }

    public function store_card_attachment($request){
        $doc_data = $this->process_documents($request, $request->card_no);
        if($doc_data){
            $data['card_attachments'] = CardAttachment::where('card_id', $request->card_no)->get();
            $data['message'] = 'Documents processed successfully';
            return $data;
        }
        return false;
    }

    public function store_card_checklist($request){
        if($request->checklist_id){
            $checklist = Checklist::find($request->checklist_id);
        } else{
            $checklist = new Checklist();
        }
        $checklist->title = $request->checklist_title;
        $checklist->card_id = $request->card_no;
        if($checklist->save()){
            $data['card_checklists'] = Checklist::where('card_id', $request->card_no)->get();
            $data['message'] = 'Checklist saved successfully.';
            return $data;
        }
        return false;
    }

    public function store_card_task($request){
        if($request->task_id){
            $task = CardTask::find($request->task_id);
        } else{
            $task = new CardTask();
        }
        $task->title = $request->task_title;
        $task->card_id = $request->card_no;
        if($task->save()){
            $data['card_tasks'] = CardTask::where('card_id', $request->card_no)->get();
            $data['message'] = 'Card saved successfully';
            return $data;
        }
        return false;
    }

    public function get_checklist_details($request){
        $checklist = Checklist::find($request->checklist_id);
        return $checklist;
    }

    public function get_task_details($request){
        $task = CardTask::find($request->task_id);
        return $task;
    }

    public function remove_card_attachment($request){
        $attachment = CardAttachment::find($request->document_id);
        if(! $attachment){
            return false;
        }
        $card_no = $attachment->card_id;
        $attachment->delete();
        $card_attachments = CardAttachment::where('card_id', $card_no)->get();
        $data['card_attachments'] = $card_attachments;
        $data['message'] = 'Attachment removed sucessfully';
        return $data;
    }

    public function remove_card_checklist($request){
        $checklist = Checklist::find($request->checklist_id);
        if(! $checklist){
            return false;
        }
        $card_no = $checklist->card_id;
        $checklist->delete();
        $card_checklists = Checklist::where('card_id', $card_no)->get();
        $data['card_checklists'] = $card_checklists;
        $data['message'] = 'Checklist removed sucessfully';
        return $data;
    }

    public function remove_card_task($request){
        $task = CardTask::find($request->task_id);
        if(! $task){
            return false;
        }
        $card_no = $task->card_id;
        $task->delete();
        $card_tasks = CardTask::where('card_id', $card_no)->get();
        $data['card_tasks'] = $card_tasks;
        $data['message'] = 'Task removed sucessfully';
        return $data;
    }

    public function create(){
        $data['statuses'] = Enums::CARD_STATUSES;
        $data['title'] = 'CARD CREATE';
        return $data;
    }

    public function edit(int $id){
        $data['statuses'] = Enums::CARD_STATUSES;
        $data['title'] = 'CARD EDIT';
        $data['card'] = Card::find($id);
        return $data;
    }

    public function destroy(int $id){

    }
}
