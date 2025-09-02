<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Exam;
use App\Models\LearningMaterial;
use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $stats = [];
        $recentData = [];

        switch ($user->role) {
            case 'admin':
                $stats = [
                    'total_users' => User::count(),
                    'total_teachers' => User::byRole('teacher')->count(),
                    'total_students' => User::byRole('student')->count(),
                    'total_parents' => User::byRole('parent')->count(),
                    'total_classes' => SchoolClass::count(),
                    'total_subjects' => Subject::count(),
                    'active_exams' => Exam::where('status', 'published')->count(),
                ];
                
                $recentData = [
                    'recent_users' => User::latest()->take(5)->get(),
                    'recent_notifications' => Notification::with(['fromUser', 'toUser'])
                        ->latest()->take(10)->get(),
                ];
                break;

            case 'teacher':
                $teacherClasses = SchoolClass::where('teacher_id', $user->id)->get();
                $teachingSubjects = \App\Models\ClassSubject::where('teacher_id', $user->id)
                    ->with(['class', 'subject'])->get();
                
                $stats = [
                    'my_classes' => $teacherClasses->count(),
                    'my_subjects' => $teachingSubjects->count(),
                    'total_students' => $teacherClasses->sum(function($class) {
                        return $class->students()->count();
                    }),
                    'pending_grades' => Grade::where('teacher_id', $user->id)
                        ->where('created_at', '>=', now()->subWeek())->count(),
                ];

                $recentData = [
                    'my_classes' => $teacherClasses,
                    'teaching_subjects' => $teachingSubjects,
                    'recent_exams' => Exam::where('teacher_id', $user->id)
                        ->latest()->take(5)->get(),
                ];
                break;

            case 'student':
                $studentClasses = $user->classes()->where('status', 'active')->get();
                $recentGrades = Grade::where('student_id', $user->id)
                    ->with(['subject', 'teacher'])->latest()->take(5)->get();
                
                $stats = [
                    'my_classes' => $studentClasses->count(),
                    'total_subjects' => Subject::count(),
                    'recent_grades' => $recentGrades->count(),
                    'attendance_rate' => $this->calculateAttendanceRate($user->id),
                ];

                $recentData = [
                    'my_classes' => $studentClasses,
                    'recent_grades' => $recentGrades,
                    'upcoming_exams' => Exam::whereIn('class_id', $studentClasses->pluck('id'))
                        ->where('start_time', '>', now())
                        ->orderBy('start_time')->take(5)->get(),
                ];
                break;

            case 'parent':
                // Find children (students linked to this parent)
                $children = User::where('parent_id', $user->id)->get();
                $childrenIds = $children->pluck('id');
                
                $stats = [
                    'total_children' => $children->count(),
                    'total_grades' => Grade::whereIn('student_id', $childrenIds)->count(),
                    'recent_attendance' => Attendance::whereIn('student_id', $childrenIds)
                        ->where('attendance_date', '>=', now()->subWeek())->count(),
                ];

                $recentData = [
                    'children' => $children,
                    'recent_grades' => Grade::whereIn('student_id', $childrenIds)
                        ->with(['student', 'subject'])->latest()->take(10)->get(),
                    'recent_notifications' => Notification::where('to_user_id', $user->id)
                        ->latest()->take(5)->get(),
                ];
                break;
        }

        return Inertia::render('dashboard', [
            'user' => $user,
            'stats' => $stats,
            'recentData' => $recentData,
        ]);
    }

    /**
     * Calculate attendance rate for a student.
     */
    protected function calculateAttendanceRate($studentId): float
    {
        $totalClasses = Attendance::where('student_id', $studentId)
            ->where('attendance_date', '>=', now()->subMonth())
            ->count();

        if ($totalClasses === 0) {
            return 0;
        }

        $presentClasses = Attendance::where('student_id', $studentId)
            ->where('attendance_date', '>=', now()->subMonth())
            ->where('status', 'present')
            ->count();

        return round(($presentClasses / $totalClasses) * 100, 2);
    }
}