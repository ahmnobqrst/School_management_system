<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\SettingInterface;

class SettingController extends Controller
{
    public $setting;

    public function __construct(SettingInterface $setting)
    {
        $this->setting = $setting;
    }
    
    public function index()
    {
        return $this->setting->index();
    }

    
    public function create()
    {
        return $this->setting->create();
    }

    
    public function store(Request $request)
    {
        return $this->setting->store($request);
    }

    
    public function show($id)
    {
        return $this->setting->show($id);
    }

    public function edit($id)
    {
        return $this->setting->edit($id);
    }

    public function update(Request $request)
    {
       return $this->setting->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->setting->destroy($request);
    }
}
