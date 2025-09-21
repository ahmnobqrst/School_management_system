<?php

namespace App\Traits;

use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;

trait ZoomTraitIntegration 
{
    public function CreateMeeting($request)
    {
        try {

            $users = Zoom::user()->all();
            \Log::info('Available Zoom users: ' . json_encode($users));
            
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
            
            \Log::info('Meeting created successfully: ' . json_encode($createdMeeting));
            
            return $createdMeeting;
            
        } catch (\Exception $e) {
            \Log::error('Zoom meeting creation error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }
}