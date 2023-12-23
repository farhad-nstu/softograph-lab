<?php

namespace App\Interfaces;

interface CardRepositoryInterface
{
    public function index();
    public function show(int $id);
    public function get_card_details($request);
    public function update_card($request);
    public function store_card_attachment($request);
    public function store_card_checklist($request);
    public function store_card_task($request);
    public function get_checklist_details($request);
    public function get_task_details($request);
    public function remove_card_attachment($request);
    public function remove_card_checklist($request);
    public function remove_card_task($request);
    public function create();
    public function store($request);
    public function edit(int $id);
    public function destroy(int $id);
}
