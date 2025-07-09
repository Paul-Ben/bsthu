<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Application;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionController extends Controller
{
    public function index()
    {
        $admissions = Application::all();
        // dd($admissions);
        return view('admissions.index', compact('admissions'));
    }

    // Bulk admission handler
    public function admitStudents() {
        // Transactional processing
    }

    // Payment-triggered student creation
    public function processPayment() {
        // Payment validation & student creation
    }

    public function filter(Request $request)
    {
        $validated = $request->validate([
            'min_score' => 'nullable|numeric',
            'program_id' => 'nullable|exists:departments,id',
            'admission_status' => 'nullable|in:pending,admitted,rejected'
        ]);

        $query = Application::withQualificationScores()
            ->whereHas('department', function($q) use ($validated) {
                if (isset($validated['program_id'])) {
                    $q->where('id', $validated['program_id']);
                }
            });

        if (isset($validated['min_score'])) {
            $query->where('qualification_score', '>=', $validated['min_score']);
        }

        return view('admissions.review', [
            'applications' => $query->paginate(15),
            'programs' => Department::all()
        ]);
    }

    public function transfer(Admission $admission)
    {
        $student = Student::create([
            'full_name' => $admission->full_name,
            'program' => $admission->program,
            'admission_id' => $admission->id,
            'admission_date' => now(),
        ]);

        $admission->delete();

        return redirect()->route('admissions.index')
            ->with('success', 'Student admitted successfully');
    }

    public function generateOfferLetter(Admission $admission)
    {
        $admission->update(['offer_date' => now(), 'status' => 'offer_sent']);
        
        return response()->streamDownload(function() use ($admission) {
            echo view('admissions.offer-letter', [
                'admission' => $admission,
                'paymentRoute' => route('admissions.payment', $admission)
            ])->render();
        }, 'offer-letter-'.$admission->id.'.pdf');
    }

    // Preserve resource methods for future use
    public function create() { /* ... */ }
    public function store(Request $request) { /* ... */ }
    public function show(Admission $admission) { /* ... */ }
    public function edit(Admission $admission) { /* ... */ }
    public function update(Request $request, Admission $admission) { /* ... */ }
    public function destroy(Admission $admission) { /* ... */ }
}
