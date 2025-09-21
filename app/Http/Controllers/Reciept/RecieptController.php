<?php

namespace App\Http\Controllers\Reciept;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\RecieptRepositoryInterface;
use App\Http\Requests\ReceiptRequest;
use App\Models\Reciept;


class RecieptController extends Controller
{
    public $Reciept;
    public function __construct(RecieptRepositoryInterface $Reciept)
    {
       return $this->Reciept = $Reciept;
    }
    public function index()
    {
       return $this->Reciept->index();
    }

   
    public function create()
    {
        //
    }

    public function store(ReceiptRequest $request)
    {
        return $this->Reciept->store($request);
    }

    public function show($id)
    {
       return $this->Reciept->show($id);
    }

    public function edit($id)
    {
       return $this->Reciept->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Reciept->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Reciept->delete($request);
    }
}
