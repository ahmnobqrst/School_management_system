<?php

namespace App\Interface;



interface OnlineClasses
{

    public function store($request);
    public function Store_offline_class($request);

    public function index();

    public function edit($id);
    public function create();

    public function update($request);

    public function destroy($request);
    public function offline_class();

}
