<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseQuestion;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $my_courses = $user->courses()->with('category')->orderBy('id', 'desc')->get();
    
        foreach ($my_courses as $course) {
            $totalQuestionsCount = $course->questions()->count();
    
            $answersQuestionCount = StudentAnswer::where('user_id', $user->id)
                ->whereHas('question', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->distinct()
                ->count('course_question_id');
    
            if ($answersQuestionCount < $totalQuestionsCount) {
                $firstUnanswereQuestion = CourseQuestion::where('course_id', $course->id)
                    ->whereNotIn('id', function ($query) use ($user) {
                        $query->select('course_question_id')->from('student_answers')
                            ->where('user_id', $user->id);
                    })->orderBy('id', 'asc')->first();
    
                $course->nextQuestionId = $firstUnanswereQuestion ? $firstUnanswereQuestion->id : null;
            } else {
                $course->nextQuestionId = null;
            }
        }

        // return  $my_courses;
        return view('student.courses.index', compact('my_courses', ));
    }
    

    public function learning(Course $course, $question)
    {
        $user = Auth::user();
        $isEndroled = $user->courses()->where('course_id', $course->id)->exists();

        if(!$isEndroled) {
            abort(404);
        }

        $curentQuestion = CourseQuestion::where('course_id', $course->id)->where('id', $question)->firstOrFail(); 

        return view('student.courses.learning', compact('course', 'curentQuestion'));
    }

    public function learning_rapport(Course $course)
    {

        $userId = Auth::id();

        $studentAnswers = StudentAnswer::with('question')
        ->whereHas('question', function ($query) use ($course) {
            $query->where('course_id', $course->id); 
        })->where('user_id', $userId)->get();

        $totalQuestions = CourseQuestion::where('course_id', $course->id)->count();

        $correctAnswersCount = $studentAnswers->where('answer', 'correct')->count();

        $passPercentage = ($correctAnswersCount / $totalQuestions) * 100;
        // $passPercentage = $correctAnswersCount == $totalQuestions;

        return view('student.courses.learning_raport', compact('course', 'passPercentage', 'studentAnswers', 'totalQuestions', 'correctAnswersCount'));
    }

    public function learning_finished(Course $course)
    {
        return view('student.courses.learning_finished', compact('course'));
    }
}
