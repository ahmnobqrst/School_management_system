<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\StudentGraduatedInterface;
use App\Models\Graduated;

class GraduatedController extends Controller
{
    protected $Graduated;
    public function __construct(StudentGraduatedInterface $Graduated){
        return $this->Graduated = $Graduated;
    }

    public function index()
    {
        return $this->Graduated->index();
    }

    public function create()
    {
        return $this->Graduated->create();
    }

    
    public function store(Request $request)
    {
        return $this->Graduated->store($request);
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
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request)
    {
        return $this->Graduated->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       return $this->Graduated->destroy($request);
    }
}
