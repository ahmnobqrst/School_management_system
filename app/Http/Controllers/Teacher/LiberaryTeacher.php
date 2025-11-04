<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Liberary;
use App\Http\Requests\LibTeacherRequest;
use App\Traits\{ZoomTraitIntegration, studentimagetrait};
use Illuminate\Support\Facades\Storage;

class LiberaryTeacher extends Controller
{

    use ZoomTraitIntegration, studentimagetrait;

    public function index()
    {
        $liberaries = Liberary::where('teacher_id', auth()->guard('teacher')->user()->id)->get();
        $grades = $this->getteachergrades();
        return view('Data.liberary.index', compact('grades', 'liberaries'));
    }


    public function create()
    {
        $grades = $this->getteachergrades();
        return view('Data.liberary.add', compact('grades'));
    }

    public function store(LibTeacherRequest $request)
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
                    'grade_id' => $request->grad_id,
                    'classroom_id' => $request->class_id,
                    'section_id' => $request->sect_id,
                    'teacher_id' => auth()->user()->id,
                ]);
            }

            toastr()->success(trans('Students_trans.Book added successfully'));
            return redirect()->route('lib.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $book = Liberary::where('teacher_id', auth()->user()->id)->findOrFail($id);
        $grades = $this->getteachersections();
        return view('Data.liberary.edit', compact('book', 'grades'));
    }

    public function update(LibTeacherRequest $request)
    {
        try {
            $liberary = Liberary::where('teacher_id', auth()->user()->id)->findOrFail($request->id);
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
                    $liberary->grade_id = $request->grad_id;
                    $liberary->classroom_id = $request->class_id;
                    $liberary->section_id = $request->sect_id;
                    $liberary->teacher_id = auth()->user()->id;

                    $liberary->save();
                }
            }

            toastr()->success(trans('Students_trans.Book updated successfully'));
            return redirect()->route('lib.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $lib = Liberary::where('teacher_id', auth()->user()->id)->findOrFail($request->id);
            if ($lib->file_name) {
                $this->delete_file($lib->file_name);
            }

            $lib->delete();
            toastr()->success(__('Students_trans.Delete_liberary'));
            return redirect()->route('lib.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function Download_Books($path)
    {
        $fullPath = 'public/' . $path;
        if (!Storage::exists($fullPath)) {
            abort(404, 'File not found.');
        }

        return Storage::download($fullPath);
    }
}
