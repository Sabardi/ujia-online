<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseQuestionController extends Controller
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
    public function create(Course $course)
    {
        return view('admin.questions.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|array',
            'answer.*' => 'required|string',
            'correct_answer' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $question = $course->questions()->create([
                'question' => $request->question,
            ]);

            foreach ($request->answer as $index => $answerText) {
                $isCorrect = ($request->correct_answer == $index);
                $question->answers()->create([
                    'answer' => $answerText,
                    'is_correct' => $isCorrect,
                    // 'question_id' => $question->id
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.courses.show', $course->id)->with('success', 'Question created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Mengelola kesalahan dengan pesan yang lebih informatif
            return redirect()->back()->withErrors([
                'system_error' => 'System error! ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseQuestion $courseQuestion)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseQuestion $courseQuestion)
    {
        $course = $courseQuestion->course;
        return view('admin.questions.edit', compact('courseQuestion', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, CourseQuestion $courseQuestion)
    // {
    //     $request->validate([
    //         'question' => 'required|string|max:255',
    //         'answer' => 'required|array',
    //         'answer.*' => 'required|string',
    //         'correct_answer' => 'required|integer',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //      $courseQuestion->update([
    //          'question' => $request->question,
    //      ]);

    //      $courseQuestion->answers()->delete();

    //         foreach ($request->answer as $index => $answerText) {
    //             $isCorrect = ($request->correct_answer == $index);
    //             $courseQuestion->answers()->create([
    //                 'answer' => $answerText,
    //                 'is_correct' => $isCorrect,
    //             ]);
    //         }

    //         DB::commit();

    //         return redirect()->route('dashboard.courses.show', $courseQuestion->course->id)->with('success', 'Course created successfully.');

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Mengelola kesalahan dengan pesan yang lebih informatif
    //         return redirect()->back()->withErrors([
    //             'system_error' => 'System error! ' . $e->getMessage(),
    //         ]);
    //     }
    // }

    public function update(Request $request, CourseQuestion $courseQuestion)
{
    $request->validate([
        'question' => 'required|string|max:255',
        'answer' => 'required|array',
        'answer.*' => 'required|string',
        'correct_answer' => 'required|integer',
    ]);

    DB::beginTransaction();

    try {
        // Update pertanyaan
        $courseQuestion->update([
            'question' => $request->question,
        ]);

        // Loop untuk memperbarui atau membuat jawaban
        foreach ($request->answer as $index => $answerText) {
            $isCorrect = ($request->correct_answer == $index);

            // Cari jawaban berdasarkan index, atau buat jika belum ada
            $answer = $courseQuestion->answers()->get()[$index] ?? null;

            if ($answer) {
                // Perbarui jawaban jika sudah ada
                $answer->update([
                    'answer' => $answerText,
                    'is_correct' => $isCorrect,
                ]);
            } else {
                // Buat jawaban baru jika tidak ada
                $courseQuestion->answers()->create([
                    'answer' => $answerText,
                    'is_correct' => $isCorrect,
                ]);
            }
        }

        DB::commit();

        return redirect()->route('dashboard.courses.show', $courseQuestion->course->id)->with('success', 'Question updated successfully.');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back()->withErrors([
            'system_error' => 'System error! ' . $e->getMessage(),
        ]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseQuestion $courseQuestion)
    {
        try {
            $courseQuestion->delete();
            return redirect()->route('dashboard.courses.show', $courseQuestion->course->id)->with('success', ' Question deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Mengelola kesalahan dengan pesan yang lebih informatif
            return redirect()->back()->withErrors([
                'system_error' => 'System error! ' . $e->getMessage(),
            ]);
        }
    }
}
