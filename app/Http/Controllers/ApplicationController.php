<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('department')->latest()->paginate(10);
        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('applications.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applications,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before:today',
            'state' => 'required|string|max:100',
            'lga' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'program_applied_id' => 'required|exists:departments,id',
            'documents' => 'required|file|mimes:pdf|max:2048'
        ]);

        if ($request->hasFile('documents')) {
            $path = $request->file('documents')->store('applications', 'public');
            $validated['document_path'] = $path;
        }

        $validated['application_no'] = 'APP-' . Str::random(8);
        $validated['status'] = 'pending';

        $application = Application::create($validated);

        return redirect()->route('applications.show', $application)
            ->with('success', 'Application submitted successfully!');
    }

    public function show(Application $application)
    {
        return view('applications.show', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        $application->update($validated);

        return redirect()->route('applications.index')
            ->with('success', 'Application status updated successfully!');
    }

    public function downloadDocument(Application $application)
    {
        if (!$application->document_path) {
            abort(404, 'Document not found');
        }

        return Storage::disk('public')->download($application->document_path);
    }
}
