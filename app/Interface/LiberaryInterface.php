<?php

namespace App\Interface;



interface LiberaryInterface
{

    public function store($request);
    public function Download_Books($request);


    public function index();

    public function edit($id);
    public function create();

    public function update($request);

    public function destroy($request);

}
