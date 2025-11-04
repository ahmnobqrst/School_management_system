<?php

namespace App\Interface;


interface TeacherRepositoryInterface{

    public function getTeachersData();
    public function getSpecializations();
    public function getGrades();
    public function getGenders();
    public function getNationality();
    public function getBloodType();
    public function StoreTeachers($request);
    public function EditTeacher($id);
    public function UpdateTeacher($request);
    public function DeleteTeacher($request);

}