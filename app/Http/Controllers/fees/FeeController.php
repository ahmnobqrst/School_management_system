<?php

namespace App\Http\Controllers\fees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\FeesRepositoryInterface;
use App\Models\Fee;
use App\Http\Requests\FeesRequest;

class FeeController extends Controller
{
    protected $Fee;
    public function __construct(FeesRepositoryInterface $Fee){
        return $this->Fee = $Fee;
    }
    public function index()
    {
        return $this->Fee->index();
    }

    
    public function create()
    {
        return $this->Fee->create();
    }

    public function store(FeesRequest $request)
    {
        return $this->Fee->store($request);
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        return $this->Fee->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeesRequest $request)
    {
        return $this->Fee->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Fee->delete($request);
    }
}
