<?php

namespace App\Interface;


interface StudentRepositoryInterface{

   public function getStudentData();
   public function CreateStudent();
   public function get_classes($id);
   public function get_sections($id);
   public function SaveStudentData($request);
   public function EditStudentData($id);
   public function UpdateStudentData($request);
   public function DeleteStudentData($request);
   public function ShowStudentData($id);
   public function save_new_images($request);
   public function Delete_attachment($request);
   public function Download_attachment($studentname,$filename);


}