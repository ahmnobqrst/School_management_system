<?php

namespace App\Interface;
use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;


interface AttendenceRepositoryInterface
{


    public function show(ReportRequest $request, $id);

    public function store($request);

    public function index();

    public function edit($id);

    public function update($request);

    public function destroy($request);

}
