<?php

namespace App\Http\Controllers\Promotion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\PromotionRepositoeyInterface;
use App\Models\Promotion;

class PromotionController extends Controller
{
    protected $Promotion;
    public function __construct(PromotionRepositoeyInterface $Promotion){
        return $this->Promotion = $Promotion;
    }


    public function index()
    {

       return $this->Promotion->getPromotions();
    }

    public function create()
    {
        $promotions = Promotion::all();
        return view('Dashboard.promotion.management_index',compact('promotions'));
    }

   
    public function store(Request $request)
    {
        return $this->Promotion->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       return $this->Promotion->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Promotion->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Promotion->destroy($request);
    }
}
