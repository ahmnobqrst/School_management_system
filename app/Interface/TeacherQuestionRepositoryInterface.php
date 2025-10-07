<?php

namespace App\Interface;


interface TeacherQuestionRepositoryInterface{

    public function index();
    public function create($section);
    public function edit($id);
    public function store($request);
    public function update($request);
    public function destroy($request);


}