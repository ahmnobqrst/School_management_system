<?php

namespace App\Interface;



interface QuizzesInterface
{


    public function show($id);

    public function store($request);

    public function index();

    public function edit($id);
    public function create();

    public function update($request);

    public function destroy($request);

}
