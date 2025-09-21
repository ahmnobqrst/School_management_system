<?php

namespace App\Http\Controllers\onlineclasses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\OnlineClasses;
use App\Http\Requests\OnlineClassRequest;
use App\Http\Requests\OfflineClassRequest;

class OnlineClassesController extends Controller
{
    public $onlineclass;
    public function __construct(OnlineClasses $onlineclass)
    {
        return $this->onlineclass = $onlineclass;
    }
    public function index()
    {
       return $this->onlineclass->index();
    }

    public function create()
    {
        return $this->onlineclass->create();
    }
    public function offline_class()
    {
        return $this->onlineclass->offline_class();
    }

   
    public function store(OnlineClassRequest $request)
    {
        return $this->onlineclass->store($request);
    }
    public function Store_offline_class(OfflineClassRequest $request)
    {
        return $this->onlineclass->Store_offline_class($request);
    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        return $this->onlineclass->edit($id);
    }

    
    public function update(ٌRequest $request)
    {
        return $this->onlineclass->update($request);
    }

    public function destroy(Request $request)
    {
       return $this->onlineclass->destroy($request);
    }
}
