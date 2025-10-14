<?php

namespace App\Repository;
use App\Interface\OnlineClasses;
use App\Models\Online_Class;
use App\Models\Grade;
use App\Traits\ZoomTraitIntegration;
use MacsiDigital\Zoom\Facades\Zoom;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OnlineClassesRepository implements OnlineClasses
{

    use ZoomTraitIntegration;

    public function index()
    {
        $online_classes = Online_Class::all();
        return view('Dashboard.online_classes.index',compact('online_classes'));
    }

public function store($request)
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
        
        Log::info('Meeting object: ' . json_encode($meeting));
        
        $onlineClass = Online_Class::create([
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $meeting->id, 
            'topic' => ['ar' => $request->topic_ar, 'en' => $request->topic_en],
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $meeting->password,
            'start_url' => $meeting->start_url,
            'join_url' => $meeting->join_url,
            'integration'=>true,
        ]);

        DB::commit();
        
        toastr()->success(trans('fee_trans.the Online Class are added successfully'));
        return redirect()->route('online_classes.index');
        
    } catch (\Exception $e) {
        DB::rollback();
        
        Log::error('Online class creation failed: ' . $e->getMessage());
        Log::error('Request data: ' . json_encode($request->all()));
        
        return redirect()->back()
               ->withInput()
               ->withErrors(['error' => 'Failed to create online class: ' . $e->getMessage()]);
    }
}
public function Store_offline_class($request)
{
    // dd($request->integration);
    DB::beginTransaction();
    
    try {
        $onlineClass = Online_Class::create([
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $request->meeting_id, 
            'topic' => ['ar' => $request->topic_ar, 'en' => $request->topic_en],
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url,
            'integration'=>false,
        ]);

        DB::commit();
        
        toastr()->success(trans('fee_trans.the Online Class are added successfully'));
        return redirect()->route('online_classes.index');
        
    } catch (\Exception $e) {
        DB::rollback();
        
        Log::error('Online class creation failed: ' . $e->getMessage());
        Log::error('Request data: ' . json_encode($request->all()));
        
        return redirect()->back()
               ->withInput()
               ->withErrors(['error' => 'Failed to create online class: ' . $e->getMessage()]);
    }
}

    public function edit($id)
    {
     
    }
    public function create()
    {
        $grades = Grade::all(); 
      return view('Dashboard.online_classes.add',compact('grades'));
    }
    public function offline_class()
    {
        $grades = Grade::all(); 
        return view('Dashboard.online_classes.indirect_connection',compact('grades'));
    }

    public function update($request)
    {

      

    }

    public function destroy($request)
    {
        
        try {
            
            $integration = Online_Class::findOrFail($request->id);
            // dd($integration->meeting_id);

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
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }


    }
}