<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegesFacultiesDepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed a college
        $college = College::firstOrCreate(['name' => 'College of Science and Technology']);

        // Seed faculties under the college
        $faculties = [
            'Faculty of Computer Science',
            'Faculty of Physical Sciences',
        ];

        foreach ($faculties as $facultyName) {
            $faculty = Faculty::firstOrCreate([
                'name' => $facultyName,
                'college_id' => $college->id,
            ]);

            // Seed departments and courses under each faculty
            if ($facultyName === 'Faculty of Computer Science') {
                $softwareEng = Department::firstOrCreate([
                    'name' => 'Department of Software Engineering',
                    'faculty_id' => $faculty->id,
                ]);

                $infoSystems = Department::firstOrCreate([
                    'name' => 'Department of Information Systems',
                    'faculty_id' => $faculty->id,
                ]);

                // Courses for Software Engineering
                Course::firstOrCreate([
                    'code' => 'SE101',
                    'title' => 'Introduction to Software Engineering',
                    'credit_load' => 3,
                    'level' => '100',
                    'semester' => 'First',
                    'department_id' => $softwareEng->id,
                ]);

                Course::firstOrCreate([
                    'code' => 'SE201',
                    'title' => 'Object-Oriented Programming',
                    'credit_load' => 3,
                    'level' => '200',
                    'semester' => 'Second',
                    'department_id' => $softwareEng->id,
                ]);

                // Courses for Information Systems
                Course::firstOrCreate([
                    'code' => 'IS101',
                    'title' => 'Information Systems Fundamentals',
                    'credit_load' => 2,
                    'level' => '100',
                    'semester' => 'First',
                    'department_id' => $infoSystems->id,
                ]);
            } elseif ($facultyName === 'Faculty of Physical Sciences') {
                $physics = Department::firstOrCreate([
                    'name' => 'Department of Physics',
                    'faculty_id' => $faculty->id,
                ]);

                $chemistry = Department::firstOrCreate([
                    'name' => 'Department of Chemistry',
                    'faculty_id' => $faculty->id,
                ]);

                // Courses for Physics
                Course::firstOrCreate([
                    'code' => 'PH101',
                    'title' => 'Classical Mechanics',
                    'credit_load' => 3,
                    'level' => '100',
                    'semester' => 'First',
                    'department_id' => $physics->id,
                ]);

                // Courses for Chemistry
                Course::firstOrCreate([
                    'code' => 'CH101',
                    'title' => 'Inorganic Chemistry',
                    'credit_load' => 3,
                    'level' => '100',
                    'semester' => 'Second',
                    'department_id' => $chemistry->id,
                ]);
            }
        }
    }
}
