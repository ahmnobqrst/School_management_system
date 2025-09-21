<?php

namespace App\Interface;



interface SubjectRepositoryInterface
{


    public function show($id);

    public function store($request);

    public function index();
    public function create();

    public function edit($id);

    public function update($request);

    public function destroy($request);

}
