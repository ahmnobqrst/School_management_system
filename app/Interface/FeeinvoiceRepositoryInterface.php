<?php

namespace App\Interface;



interface FeeinvoiceRepositoryInterface
{


    public function show($id);

    public function store($request);

    public function index();

    public function edit($id);

    public function update($request);

    public function delete($request);

}
