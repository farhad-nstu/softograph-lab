<?php

namespace App\Interfaces;

interface CardRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit(int $id);
    public function update($request, int $id);
    public function destroy(int $id);
}
