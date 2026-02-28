<?php

namespace App\Http\Controllers\attendence;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;
use App\Interface\AttendenceRepositoryInterface;

class AttendenceController extends Controller
{
    
    public $attendence;

    public function __construct(AttendenceRepositoryInterface $attendence)
    {
     return $this->attendence = $attendence;
    }


    public function index()
    {
        return $this->attendence->index();
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        return $this->attendence->store($request);
    }

    public function show(ReportRequest $request, $id)
    {
        return $this->attendence->show($request, $id);
    }

    public function edit($id)
    {
        return $this->attendence->edit($id);
    }

    public function update(Request $request)
    {
        return $this->attendence->update($request);
    }

   
    public function destroy(Request $request)
    {
        return $this->attendence->destroy($request);
    }
}
