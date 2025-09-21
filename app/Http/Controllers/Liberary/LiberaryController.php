<?php

namespace App\Http\Controllers\Liberary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\LiberaryInterface;
use App\Http\Requests\LiberaryRequest;

class LiberaryController extends Controller
{
    public $liberary;
    public function __construct(LiberaryInterface $liberary)
    {
        return $this->liberary = $liberary;
    }
    public function index()
    {
        return $this->liberary->index();
    }

    public function create()
    {
        return $this->liberary->create();
    }

    public function store(LiberaryRequest $request)
    {
        return $this->liberary->store($request);
    }
    public function show(string $id)
    {
        //
    }

   
    public function edit($id)
    {
        return $this->liberary->edit($id);
    }
    public function Download_Books($path)
    {
        return $this->liberary->Download_Books($path);
    }

    public function update(Request $request)
    {
       return $this->liberary->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->liberary->destroy($request);
    }
}
