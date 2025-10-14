<?php

namespace App\Repository;

use App\Interface\LiberaryInterface;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Liberary;
use App\Traits\studentimagetrait;
use Illuminate\Support\Facades\Storage;
use Hash;
use DB;

class LiberaryRepository implements LiberaryInterface
{

  use studentimagetrait;
  public function index()
  {
    $liberaries = Liberary::all();
    return view('Dashboard.liberary.index', compact('liberaries'));
  }

  public function store($request)
  {

    try {

      if (!$request->file_name) {
        toastr()->error(trans('Students_trans.Please upload at least one file'));
        return redirect()->back();
      }

      $files = $request->file_name;

      foreach ($files as $file) {
        Liberary::create([
          'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
          'file_name' => $this->uploadImageimage($file, 'Books'),
          'grade_id' => $request->grade_id,
          'classroom_id' => $request->classroom_id,
          'section_id' => $request->section_id,
          'teacher_id' => 1,
        ]);
      }

      toastr()->success(trans('Students_trans.Book added successfully'));
      return redirect()->route('liberary.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }


  public function edit($id)
  {
    $book = Liberary::findOrFail($id);
    $grades = Grade::all();

    return view('Dashboard.liberary.edit', compact('book', 'grades'));
  }
  public function Download_Books($path)
  {
    $fullPath = 'public/' . $path;
    if (!Storage::exists($fullPath)) {
      abort(404, 'File not found.');
    }

    return Storage::download($fullPath);
  }
  // {
  //   dd($path);
  //     $fullPath = 'public/' . $path;
  //     if (!Storage::exists($fullPath)) {
  //         abort(404, 'File not found.');
  //     }

  //     return Storage::download($fullPath);
  // }
  public function create()
  {
    $grades = Grade::all();
    return view('Dashboard.liberary.add', compact('grades'));
  }
  public function offline_class() {}

  public function update($request)
  {
    try {
      $liberary = Liberary::findOrFail($request->id);
      if (!$liberary->file_name) {
        toastr()->error(trans('Students_trans.Please upload at least one file'));
        return redirect()->back();
      }

      $files = $request->file_name;


      foreach ($files as $file) {
        if ($file) {

          $this->delete_file($liberary->file_name);

          $new_file = $this->uploadImageimage($file, 'Books');

          $liberary->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
          $liberary->file_name =  $new_file;
          $liberary->grade_id = $request->grade_id;
          $liberary->classroom_id = $request->classroom_id;
          $liberary->section_id = $request->section_id;
          $liberary->teacher_id = 1;

          $liberary->save();
        }
      }

      toastr()->success(trans('Students_trans.Book updated successfully'));
      return redirect()->route('liberary.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  public function destroy($request)
  {
    $lib = Liberary::findOrFail($request->id);
    if ($lib->file_name) {
      $this->delete_file($lib->file_name);
    }

    $lib->delete();
    toastr()->success(__('Students_trans.Delete_liberary'));
    return redirect()->route('liberary.index');
  }
}
