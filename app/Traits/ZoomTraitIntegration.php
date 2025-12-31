<?php

namespace App\Traits;

use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;
use App\Models\{Teacher,Grade,Section, Student};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ZoomTraitIntegration 
{
    public function CreateMeeting($request)
    {
        try {

            $users = Zoom::user()->all();
            Log::info('Available Zoom users: ' . json_encode($users));
            
            $user = Zoom::user()->first();
            
            if (!$user) {
                throw new \Exception('No Zoom user found. Please check your OAuth connection.');
            }

            $startTime = Carbon::parse($request->start_time)->toISOString();
            
            $meeting = Zoom::meeting()->make([
                'topic' => $request->topic_en,
                'duration' => (int)$request->duration,
                'password' => $request->password,
                'start_time' => $startTime,
                'timezone' => 'Africa/Cairo',
                'type' => 2, // Scheduled meeting
            ]);
            
            $meeting->settings()->make([
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'mute_upon_entry' => true,
                'waiting_room' => true,
                'approval_type' => 2,
                'audio' => 'both',
                'auto_recording' => 'none'
            ]);

            $createdMeeting = $user->meetings()->save($meeting);
            
            Log::info('Meeting created successfully: ' . json_encode($createdMeeting));
            
            return $createdMeeting;
            
        } catch (\Exception $e) {
            Log::error('Zoom meeting creation error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    public function getteachergrades()
    {
        $teacher = Teacher::with('grade')
        ->where('id', auth()->user()->id)
        ->firstOrFail();
        return collect([$teacher->grade]);
    }
    public function getteachergrade()
    {
        $grade = Teacher::with('grade')
         ->findOrFail(auth()->user()->id);
        return $grade;
    }

    public function getSections()
    {
        $teacher = Teacher::with('Sections.Classes')
        ->findOrFail(auth()->user()->id);
        $sections = $teacher->sections;

        return $sections;
    }
    public function get_childerns_data()
    {
        $students = Student::where('parent_id', auth()->user()->id)
        ->select('id','name','email','grade_id','classroom_id','section_id')
        ->get();

        return $students;
    }
    
    public function get_childern_data($studentId)
    {
        $student = Student::findOrFail($studentId);
        return $student;
    }
}