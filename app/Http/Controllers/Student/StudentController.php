<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Classroom;
use App\Interface\StudentRepositoryInterface;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{

    protected $Student;
    public function __construct(StudentRepositoryInterface $Student)
    {
        return $this->Student = $Student;
    }



    public function index()
    {
        return $this->Student->getStudentData();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Student->CreateStudent();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        return $this->Student->SaveStudentData($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Student->ShowStudentData($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Student->EditStudentData($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request)
    {
        return $this->Student->UpdateStudentData($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($request)
    {
        return $this->Student->DeleteStudentData($request);
    }

    public function get_classes($id)
    {
        return $this->Student->get_classes($id);
    }

    public function get_sections($id)
    {
        return $this->Student->get_sections($id);
    }

    public function save_new_images(Request $request)
    {
        return $this->Student->save_new_images($request);
    }
    public function Delete_attachment(Request $request)
    {
        return $this->Student->Delete_attachment($request);
    }

    public function Download_attachment($studentname, $filename)
    {
        return $this->Student->Download_attachment($studentname, $filename);
    }

    
}
