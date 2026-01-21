<?php

namespace App\Repository;

use App\Interface\ClassScheduleInterface;

use App\Models\Grade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassScheduleRepository implements ClassScheduleInterface
{

    public function index()
    {
        return "helllodddkdjkd";
    }
    public function store($request){}
    public function edit($id) {}
    public function create(){}
    public function update($request) {}
    public function destroy($request){}
}
