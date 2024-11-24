<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\StudentAnswer;
use App\Models\User;
// use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $students = $course->students()->orderBy('id', 'DESC')->get();

        // return $students;
        $questions = $course->questions()->orderBy('id', 'DESC')->get();
        // return $questions;
        $totalQuestions = $questions->count();

        foreach ($students as $student) {
            $studentAnswers = StudentAnswer::whereHas('question', function ($query) use ($course) {
                $query->where('course_id', $course->id);
            })->where('user_id', $student->id)
            ->get();

            $answerCount = $studentAnswers->count();
                        
            $correctAnswerCount = $studentAnswers->where('answer', 'correct')->count();

            // return $studentAnswers . '<br>' . $answerCount . '<br>' . $correctAnswerCount;

            if ($answerCount == 0) {
                $student->status = 'Not Started';
            } elseif ($correctAnswerCount < $totalQuestions) {
                $student->status = 'Not Passed';
            } elseif ($correctAnswerCount == $totalQuestions) {
                $student->status = 'Passed';
            }
        }

        // return $students;

        return view('admin.students.index', compact('course', 'questions', 'students'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $student = $course->students()->orderBy('id', 'desc')->get();

        return view('admin.students.add_student', compact('course', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'email' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'system_error' => ['Student email not found!'],
            ]);
        }

        // $isEndroled = $course->students()->where('user_id', $user->id)->exists();
        // cara langsung
        if ($course->students()->where('user_id', $user->id)->exists()) {
            throw ValidationException::withMessages([
                'system_error' => ['Student already has access!'],
            ]);
        }

        if ($user->hasRole('teacher')) {
            throw ValidationException::withMessages([
                'system_error' => ['User is not a student!'],
            ]);
        }    

        DB::beginTransaction();

        try {
            $course->students()->attach($user->id);
            DB::commit();

            return redirect()->route('dashboard.course.course.student.index', $course)->with('success', 'Student added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            throw ValidationException::withMessages([
                'system_error' => [$e->getMessage()],
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseStudent $courseStudent)
    {
        //
    }
}
