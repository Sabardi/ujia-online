<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAnswer;
use App\Models\CourseQuestion;
use App\Models\StudentAnswer;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course,  $question)
    {
        $question_details = CourseQuestion::where('id', $question)->first();

        $validated = $request->validate([
           'answer_id' => 'required|exists:course_answers,id'
        ]);

        DB::beginTransaction();

        try {
            $selectedAnswer = CourseAnswer::find($validated['answer_id']);

            // return $selectedAnswer;
            if ($selectedAnswer->course_question_id != $question) {
                $error = ValidationException::withMessages([
                    'system_error' => ['jawaban tidak tersedia pada pertanyaan!'],
                ]);
                throw $error;
            }

            $existAnswer = StudentAnswer::where('user_id', Auth::id())->where('course_question_id', $question)->first();
            
            if ($existAnswer) {
                $error = ValidationException::withMessages([
                    'system_error' => ['anda sudah menjawab pertanyaan ini!'],
                ]);
                throw $error;
            }

            $answerValue = $selectedAnswer->is_correct ? 'correct' : 'wrong';

            StudentAnswer::create([
                'user_id' => Auth::id(),
                'course_question_id' => $question,
                'answer' => $answerValue,
            ]);

            DB::commit();

            $nextQuestion = CourseQuestion::where('course_id', $course->id)->where('id', '>', $question)
            ->orderBy('id', 'asc')->first();

            if ($nextQuestion) {
                // route('dashboard.learning.course', ['course' => $course->id, 'question' => $course->nextQuestionId])                
                return redirect()->route('dashboard.learning.course', ['course' => $course->id, $nextQuestion->id]);
            } else {
                // return "done";
                return redirect()->route('dashboard.learning.finished.course', $course->id);
            }

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentAnswer $studentAnswer)
    {
        //
    }
}
