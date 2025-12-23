<?php

namespace App\Livewire;

use App\Models\Question;
use App\Models\StudentQuizResult;
use App\Models\StudentResponse;
use Livewire\Component;

class ShowStudentQuestions extends Component
{
    public $student_id, $quiz_id, $data, $counter = 0, $questionCount = 0;
    public function render()
    {
        $this->data = Question::where('quiz_id', $this->quiz_id)->get();
        $this->questionCount = $this->data->count();
        return view('livewire.show-student-questions', ['data', 'questionCount']);
    }

    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {
        $student_response = StudentResponse::where('quiz_id', $this->quiz_id)->where('student_id', $this->student_id)->first();
            if ($student_response == null) {
                $response =  new StudentResponse();
                $response->quiz_id = $this->quiz_id;
                $response->student_id = $this->student_id;
                $response->question_id = $question_id;
                $response->answer = $answer;
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $response->score += $score;
                } else {
                    $response->score += 0;
                }
                $response->date = date('Y-m-d');
                $response->save();
            }
            else
            {
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                  $student_response->score = $score;
                } else {
                    $student_response->score = 0;
                }
                StudentResponse::updateOrCreate([
                    'quiz_id'=>$this->quiz_id,
                    'student_id'=>$this->student_id,
                    'question_id'=>$question_id,
                ],
                [ 
                   'answer'=>$answer,
                   'score'=>$student_response->score,
                   'date'=>date('Y-m-d')
                ]);
            }

            if($this->counter < $this->questionCount -1)
            {
                $this->counter ++;
            }
            else
            {
                $quiz_dergree = Question::where('quiz_id',$this->quiz_id)->sum('degree');
                $student_score = $student_response->where('quiz_id',$this->quiz_id)->sum('score');

                if($student_score < $quiz_dergree/2)
                {
                    $status = 'failed';
                }
                else
                {
                   $status = 'passed';
                }

                StudentQuizResult::create([
                   'quiz_id'=>$this->quiz_id,
                   'student_id'=>$this->student_id,
                   'score'=>$student_score,
                   'status'=>$status
                ]);

                toastr()->success(__('Students_trans.finished_of_Exam'));
                return redirect()->route('student_exams.index');
            }

           

       


      

    }
}
