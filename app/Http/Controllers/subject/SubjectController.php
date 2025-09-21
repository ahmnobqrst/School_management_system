<?php

namespace App\Http\Controllers\subject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\SubjectRepositoryInterface;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
    public $subject;
    public function __construct(SubjectRepositoryInterface $subject)
    {
        return $this->subject = $subject;
    }
    public function index()
    {
        return $this->subject->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->subject->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        return $this->subject->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->subject->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->subject->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request)
    {
        return $this->subject->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->subject->destroy($request);
    }
}
