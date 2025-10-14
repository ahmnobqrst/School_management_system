<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{OnlineClassRequest,OfflineClassRequest};
use App\Models\{Teacher, Grade, Online_Class};
use App\Traits\ZoomTraitIntegration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MacsiDigital\Zoom\Facades\Zoom;

class TeacherClassesController extends Controller
{
    use ZoomTraitIntegration;

    public function index()
    {
        $online_classes = Online_Class::all();
        return view('Data.classes.index', compact('online_classes'));
    }

    public function get_online_form()
    {
        $grades = $this->getteachersections();
        return view('Data.classes.create',compact('grades'));
    }
    public function get_offline_form()
    {
        $grades = $this->getteachersections();
       return view('Data.classes.create_offline',compact('grades'));
    }

    public function online_create_class(OnlineClassRequest $request)
    {
        DB::beginTransaction();

        try {
            $meetingPassword = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
            $request->merge(['password' => $meetingPassword]);

            Log::info('Creating Zoom meeting with data: ' . json_encode($request->all()));

            $meeting = $this->CreateMeeting($request);

            if (!$meeting) {
                throw new \Exception('Failed to create Zoom meeting - no meeting object returned');
            }

            $onlineClass = Online_Class::create([
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->guard('teacher')->user()->id,
                'meeting_id' => $meeting->id,
                'topic' => ['ar' => $request->topic_ar, 'en' => $request->topic_en],
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
                'integration' => true,
            ]);

            DB::commit();

            toastr()->success(trans('fee_trans.the Online Class are added successfully'));
            return redirect()->route('classes.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create online class: ' . $e->getMessage()]);
        }
    }
    public function offline_create_class(OfflineClassRequest $request)
    {

        
        DB::beginTransaction();

        try {
            $onlineClass = Online_Class::create([
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->guard('teacher')->user()->id,
                'meeting_id' => $request->meeting_id,
                'topic' => ['ar' => $request->topic_ar, 'en' => $request->topic_en],
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
                'integration' => false,
            ]);

            DB::commit();

            toastr()->success(trans('fee_trans.the Online Class are added successfully'));
            return redirect()->route('classes.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create online class: ' . $e->getMessage()]);
        }
    }

    public function delete_online_class(Request $request)
    {
       try {
            
            $integration = Online_Class::findOrFail($request->id);

            if($integration->integration == 1)
            {
                
                $meeting = Zoom::meeting()->find($request->meeting_id);
                if($meeting)
                {
                  $meeting->delete();
                  Online_Class::destroy($request->id);
                }else{
                    Online_Class::destroy($request->id);
                } 
            }
            else{
                 Online_Class::destroy($request->id);
            }
            
            toastr()->success(trans('fee_trans.Delete_class'));
             return redirect()->route('classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function sections()
    {
        $grades = $this->getteachersections();
        return view('Data.allsections', compact('grades'));
    }
}
