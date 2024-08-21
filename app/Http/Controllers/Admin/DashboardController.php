<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Student;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(protected Post $post, protected Student $student) {
    }

    public function __invoke(): View
    {
        $totalStudents = $this->student->count();
        $totalPosts = $this->post->count();
        $pendingPosts = $this->post->onlyPending()->count();
        $approvedPosts = $this->post->onlyPending()->count();

        $latestStudents = $this->student->with('user')->latest()->limit(8)->get();

        return view('admin.dashboard', compact('totalStudents', 'totalPosts', 'pendingPosts', 'approvedPosts', 'latestStudents'));
    }
}
