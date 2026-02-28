<?php

namespace App\Http\Controllers\Grade;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Classroom;
use App\Http\Requests\GradeRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\softDeletes;

use Illuminate\Http\Request;

class GradeController extends Controller
{

  use softDeletes;
  public function index()
  {
    $grades = Grade::all();
    return view('Dashboard.Grade.index', compact('grades'));
  }


  public function create()
  {
    $grade = Grade::all();
    return view('Dashboard.Grade.create', compact('grade'));
  }



  public function store(GradeRequest $request)
  {

    try {
      $grade = new Grade();
      $grade->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
      $grade->desc = ['ar' => $request->desc_ar, 'en' => $request->desc_en];
      $grade->save();


      return redirect()->route('grades.index')->with(['addeded' => trans('grades_trans.the stage are added successfully')]);
    } catch (\Exception $e) {

      return $e->getMessage();
    }
  }

  public function show($id) {}
  public function edit($id)
  {
    $Grade = Grade::findOrFail($id);
    return view('Dashboard.Grade.edit', compact('Grade'));
  }

  public function update(GradeRequest $request)
  {

    $Grade = Grade::findOrFail($request->id);
    $Grade->update([
      $Grade->name = ['ar' => $request->name_ar, 'en' => $request->name_en],
      $Grade->desc = ['ar' => $request->desc_ar, 'en' => $request->desc_en],
    ]);
    toastr()->success(trans('grades_trans.update_grade'));
    return redirect()->route('grades.index');
  }

  public function destroy(Request $request)
  {
    $myclass_id = Classroom::where('Grade_id', $request->id)->pluck('Grade_id');
    if ($myclass_id->count() == 0) {
      if (is_numeric($request->id)) {
        Grade::where('id', $request->id)->delete();
      }
      toastr()->success(trans('grades_trans.Delete_grade'));
      return redirect()->route('grades.index');
    } else {
      toastr()->error(trans('grades_trans.error_grade_delete'));
      return redirect()->route('grades.index');
    }
  }
}
