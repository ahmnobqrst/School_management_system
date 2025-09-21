<?php

namespace App\Http\Controllers\process;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\processingFeeRepositoryInterface;

class ProcessingFee extends Controller
{
   
    protected $ProceesingFee;

    public function __construct(processingFeeRepositoryInterface $ProceesingFee)
    {
      return $this->ProceesingFee = $ProceesingFee;
    }
    
    public function index()
    {
        return $this->ProceesingFee->index();
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
         return $this->ProceesingFee->store($request);
    }

    public function show($id)
    {
        return $this->ProceesingFee->show($id);
    }

    public function edit($id)
    {
        return $this->ProceesingFee->edit($id);
    }

   
    public function update(Request $request)
    {
        return $this->ProceesingFee->update($request);
    }

    
    public function destroy(Request $request)
    {
       return $this->ProceesingFee->destroy($request);
    }
}
