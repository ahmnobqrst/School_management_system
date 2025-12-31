<?php

namespace App\Http\Controllers\parents;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Traits\ZoomTraitIntegration;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    use ZoomTraitIntegration;

    public function get_all_students()
    {
        $students = $this->get_childerns_data();
        return view('Dashboard.parents.childerns.childerns',compact('students'));
    }

    public function show($studentId)
    {
        $student = $this->get_childern_data($studentId);
        return view('Dashboard.parents.childerns.all_data_of_childern',compact('student'));
    }
}
