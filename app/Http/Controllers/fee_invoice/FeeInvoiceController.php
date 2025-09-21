<?php

namespace App\Http\Controllers\fee_invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\FeeinvoiceRepositoryInterface;

class FeeInvoiceController extends Controller
{

    public $FeeInvoice;
    public function __construct(FeeinvoiceRepositoryInterface $FeeInvoice)
    {
        return $this->FeeInvoice = $FeeInvoice;
    }
    public function index()
    {
       return $this->FeeInvoice->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->FeeInvoice->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->FeeInvoice->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       return $this->FeeInvoice->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->FeeInvoice->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->FeeInvoice->delete($request);
    }
}
