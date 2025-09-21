<?php

namespace App\Interface;



interface QuestionsInterface
{

    public function store($request);

    public function index();

    public function edit($id);
    public function create();

    public function update($request);

    public function destroy($request);

}
