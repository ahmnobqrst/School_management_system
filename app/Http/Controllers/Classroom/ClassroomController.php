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
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $myclass = Classroom::paginate(10);
    $grades = Grade::paginate(10);
    return view('Dashboard.classroom.index', compact('myclass', 'grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $myclass = Classroom::all();
    $grades = Grade::all();
    return view('Dashboard.classroom.create', compact('myclass', 'grades'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
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
          'desc' => null,
          'Grade_id' => $list_class['grade_id'],
        ]);
      }

      if (count($duplicates) > 0) {
        toastr()->warning(trans('section_trans.the Classroon already exists')." ".implode(',', $duplicates));
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

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id) {}

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Classroom $Classroom)
  {

    $grades = Grade::all();

    return view('Dashboard.classroom.edit', compact('Classroom', 'grades'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
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


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */

  public function Delete($myclasses_id)
  {
    $classrooms = Classroom::find($myclasses_id); // equal offer::where('id','$offer_id')->first();
    if (!$classrooms)
      toastr()->error(trans('class_trans.error'));
    //return redirect()->back()->with(['error'=>__('class_trans.error')]);

    $classrooms->delete();
    toastr()->success(trans('class_trans.the item classroom are deleted successfully'));
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




  public function destroy($id) {}
}
