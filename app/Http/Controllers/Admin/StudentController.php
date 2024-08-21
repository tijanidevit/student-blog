<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(protected Student $student) {
    }

    public function index(Request $request)
    {
        $students = $this->student->with([
            'user' => function ($query) {
                $query->withCount('posts');
            }
        ])->latest()->paginate();
        return view('admin.dashboard', compact('totalStudents', 'totalPosts', 'pendingPosts', 'approvedPosts', 'latestStudents'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id): View
    {
        $student = $this->student->with([
            'user' => function ($query) {
                $query->withCount('posts')->with('posts');
            }
        ])->latest()->findOrFail($id);

        return view('admin.student.show', compact('student'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
