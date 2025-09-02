<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\ClassSubject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MadrasahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@aimadrasah.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '08123456789',
            'status' => 'active',
        ]);

        // Create teachers
        $teachers = User::factory()->count(10)->teacher()->create();
        
        // Create students
        $students = User::factory()->count(50)->student()->create();
        
        // Create parents
        $parents = User::factory()->count(25)->parent()->create();
        
        // Link some parents to students
        foreach ($students->take(25) as $index => $student) {
            $student->update([
                'parent_id' => $parents[$index]->id,
            ]);
        }

        // Create subjects
        $subjectData = [
            ['name' => 'Matematika', 'code' => 'MTK', 'credits' => 4],
            ['name' => 'Bahasa Indonesia', 'code' => 'BID', 'credits' => 4],
            ['name' => 'Bahasa Inggris', 'code' => 'BIG', 'credits' => 3],
            ['name' => 'IPA', 'code' => 'IPA', 'credits' => 4],
            ['name' => 'IPS', 'code' => 'IPS', 'credits' => 3],
            ['name' => 'Pendidikan Agama Islam', 'code' => 'PAI', 'credits' => 3],
            ['name' => 'Pendidikan Kewarganegaraan', 'code' => 'PKN', 'credits' => 2],
            ['name' => 'Seni Budaya', 'code' => 'SBD', 'credits' => 2],
            ['name' => 'Penjas', 'code' => 'PJS', 'credits' => 2],
            ['name' => 'Prakarya', 'code' => 'PKY', 'credits' => 2],
        ];

        foreach ($subjectData as $data) {
            Subject::create([
                'name' => $data['name'],
                'code' => $data['code'],
                'description' => 'Mata pelajaran ' . $data['name'] . ' untuk tingkat SMP/MTs',
                'credits' => $data['credits'],
                'status' => 'active',
            ]);
        }

        // Create classes
        $classes = [];
        foreach (['7', '8', '9'] as $grade) {
            foreach (['A', 'B', 'C'] as $section) {
                $class = SchoolClass::create([
                    'name' => "Kelas {$grade}-{$section}",
                    'grade' => $grade,
                    'teacher_id' => $teachers->random()->id,
                    'capacity' => 30,
                    'description' => "Kelas {$grade} bagian {$section}",
                    'status' => 'active',
                ]);
                $classes[] = $class;
            }
        }

        // Assign students to classes
        $studentsCollection = collect($students);
        $studentsPerClass = 15;
        
        foreach ($classes as $index => $class) {
            $classStudents = $studentsCollection->slice($index * $studentsPerClass, $studentsPerClass);
            
            foreach ($classStudents as $student) {
                $class->students()->attach($student->id, [
                    'academic_year' => '2024/2025',
                    'status' => 'active',
                ]);
            }
        }

        // Assign subjects to classes with teachers
        $subjects = Subject::all();
        
        foreach ($classes as $class) {
            foreach ($subjects as $subject) {
                ClassSubject::create([
                    'class_id' => $class->id,
                    'subject_id' => $subject->id,
                    'teacher_id' => $teachers->random()->id,
                    'schedule_day' => fake()->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
                    'schedule_time' => fake()->time(),
                    'duration' => 45,
                ]);
            }
        }
    }
}