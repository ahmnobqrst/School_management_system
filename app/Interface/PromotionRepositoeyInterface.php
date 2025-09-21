<?php

namespace App\Interface;


interface PromotionRepositoeyInterface{

  public function getPromotions();
  public function store($request);
  public function edit($id);

  public function destroy($request);
  public function update($request);


}
