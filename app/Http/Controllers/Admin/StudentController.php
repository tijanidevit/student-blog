<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
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
        ])
        ->search('matric_no',$request->search)
        ->orWhereHas('user', function ($query) use($request) {
            $query->search('name',$request->search)
            ->orSearch('email',$request->search);
        })
        ->filterByDate($request->from_date, $request->to_date)
        ->latest()->paginate();
        return view('admin.student.index', compact('students'));
    }

    public function show(Request $request, string $id): View
    {
        $student = $this->student->with([
            'user' => function ($query) {
                $query->withCount('posts')->with('posts');
            }
        ])->latest()->findOrFail($id);


        $posts = Post::with('category')
                    ->where('user_id', $student->user->id)
                    ->search('title',$request->search)
                    ->orSearch('content',$request->search)
                    ->filterByDate($request->from_date, $request->to_date)
                    ->latest()
                    ->paginate();

        return view('admin.student.show', compact('student', 'posts'));
    }
}
