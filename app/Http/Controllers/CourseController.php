<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Dotenv\Exception\ValidationException;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'category_id' => 'required|integer',
    //         'cover' => 'required|image|mimes:png,jpg,svg',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         if ($request->hasFile('cover')) {
    //             $coverPath = $request->file('cover')->store('product_covers', 'public');
    //             $validated['cover'] = $coverPath;
    //         }

    //         $validated['slug'] = Str::slug($request->name);
    //         $newCourse = Course::create($validated);

    //         DB::commit();

    //         return redirect()->route('dashboard.courses.index');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         $error = ValidationException::withMessages([
    //             'system_error' => ['System error! ' . $e->getMessage()],
    //         ]);

    //         throw $error;
    //     }
    // }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'cover' => 'required|image|mimes:png,jpg,svg',
        ]);
        
        DB::beginTransaction();
    
        try {
            // Simpan file cover jika ada
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }
            
            // Buat slug dari nama
            $validated['slug'] = Str::slug($request->name);
            
            // Buat course baru
            Course::create($validated);
             
            DB::commit();
            
            return redirect()->route('dashboard.courses.index')->with('success', 'Course created successfully.');
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
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
