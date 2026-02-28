<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Grade;
use App\Models\Classroom;
use App\Http\Requests\ClassRequest;
use Illuminate\Database\Eloquent\softDeletes;

use Illuminate\Http\Request;

class ClassroomController extends Controller
{


  use softDeletes;

  public function index()
  {
    $myclass = Classroom::paginate(10);
    $grades = Grade::paginate(10);
    return view('Dashboard.classroom.index', compact('myclass', 'grades'));
  }

  public function create()
  {
    $myclass = Classroom::all();
    $grades = Grade::all();
    return view('Dashboard.classroom.create', compact('myclass', 'grades'));
  }


  public function store(ClassRequest $request)
  {

    try {
      $list_classes = $request->class_list;
      $validated = $request->validated();

      $duplicates = [];

      foreach ($list_classes as $list_class) {
        $exists = Classroom::where('Grade_id', $list_class['grade_id'])
          ->where(function ($query) use ($list_class) {
            $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) = ?", [$list_class['name_ar']])
              ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) = ?", [$list_class['name_en']]);
          })
          ->exists();

        if ($exists) {
          $duplicates[] = $list_class['name_ar'];
          continue;
        }
        Classroom::create([
          'name' => ['ar' => $list_class['name_ar'], 'en' => $list_class['name_en']],
          'desc' => $list_class['desc_ar'],
          'Grade_id' => $list_class['grade_id'],
        ]);
      }

      if (count($duplicates) > 0) {
        toastr()->warning(trans('section_trans.the Classroon already exists') . " " . implode(',', $duplicates));
      } else {
        toastr()->success(trans('class_trans.the data are saved'));
      }
      return redirect()->route('classrooms.index');
    } catch (\Exception $e) {
      toastr()->error(trans('class_trans.the data are not saved'));
      return redirect()->route('classrooms.index');
    }



    //return redirect()->back()->with(['exists'=>trans('class_trans.the class are saved')]);

  }

  public function filteration_class(Request $request)
  {
    $grades = Grade::paginate(10);
    $search = Classroom::select('*')->where('Grade_id', '*', $request->Grade_id)->paginate(10);
    return view('Dashboard.classroom.index', compact('grades'))->withDetails('search');
  }

  public function show($id) {}

  public function edit(Classroom $Classroom)
  {

    $grades = Grade::all();

    return view('Dashboard.classroom.edit', compact('Classroom', 'grades'));
  }


  public function update(Request $request, Classroom $Classroom)
  {
    $Classrooms = Classroom::findOrFail($Classroom->id);
    $Classrooms->update([

      $Classrooms->name = ['ar' => $request->name_ar, 'en' => $request->name_en],
      $Classrooms->desc = ['ar' => $request->desc_ar, 'en' => $request->desc_en],
      $Classrooms->Grade_id = $request->grade_id,
    ]);
    toastr()->success(trans('class_trans.the data are update'));
    return redirect()->route('classrooms.index');
  }




  public function Delete_all(Request $request)
  {


    $items = explode(',', $request->delete_all_id);

    if (!empty($items)) {
      Classroom::whereIn('id', $items)->delete();

      toastr()->success(trans('class_trans.the item classroom are deleted successfully'));
      return redirect()->route('classrooms.index');
    } else {
      toastr()->error(trans('class_trans.no classes selected to detection'));
      return redirect()->route('classrooms.index');
    }
  }




  public function destroy(Request $request)
  {
    $classroom = Classroom::findOrFail($request->id);
    $classroom->delete();
    toastr()->success(trans('class_trans.the item classroom are deleted successfully'));
    return redirect()->route('classrooms.index');
  }
}
