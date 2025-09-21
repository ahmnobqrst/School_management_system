<?php

namespace App\Interface;


interface StudentGraduatedInterface
{
    public function index();

    public function create();

    public function store($request);
    public function destroy($request);
    public function update($request);



}
