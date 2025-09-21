<?php

namespace App\Interface;


interface FeesRepositoryInterface{

 public function index();

 public function create();

 public function store($request);

 public function edit($id);

 public function update($request);

 public function Delete($request);

}
