<?php

namespace App\Http\Controllers\classScehdule;

use App\Http\Controllers\Controller;
use App\Interface\ClassScheduleInterface;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    public $cschedule;
    public function __construct(ClassScheduleInterface $cschedule)
    {
        $this->cschedule = $cschedule;
    }
    
    public function index()
    {
        return $this->cschedule->index();
    }

    
    public function create()
    {
        return $this->cschedule->create();
    }

    
    public function store(Request $request)
    {
        return $this->cschedule->store($request);
    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        return $this->cschedule->edit($id);
    }

    public function update(Request $request,$id)
    {
        return $this->cschedule->update($request);
    }

    
    public function destroy($id)
    {
        return $this->cschedule->destroy($id);
    }
}
