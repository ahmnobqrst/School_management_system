<?php

namespace App\Interface;



interface AttendenceRepositoryInterface
{


    public function show($id);

    public function store($request);

    public function index();

    public function edit($id);

    public function update($request);

    public function destroy($request);

}
