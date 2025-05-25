<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    public function index()
    {
        $patients = Patient::with(['examinations' => function($query) {
            $query->latest();
        }])->latest()->paginate(10);
        
        return view('examinations.index', compact('patients'));
    }

    public function createExamination($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        if (!in_array(Auth::user()->role, ['perawat', 'dokter'])) {
            abort(403, 'Unauthorized');
        }

        return view('examinations.create', compact('patient'));
    }

    public function storeExamination(Request $request, $patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $userRole = auth()->user()->role;

        $examination = new Examination();
        $examination->patient_id = $patient_id;

        if ($userRole == 'perawat') {
            $request->validate([
                'weight' => 'required|numeric|min:1|max:500',
                'blood_pressure' => 'required|string|max:20',
            ]);
            
            $examination->weight = $request->weight;
            $examination->blood_pressure = $request->blood_pressure;
            $examination->nurse_id = auth()->id();
        }

        if ($userRole == 'dokter') {
            $request->validate([
                'complaint' => 'required|string|max:1000',
                'diagnosis' => 'required|string|max:1000',
            ]);
            
            $examination->complaint = $request->complaint;
            $examination->diagnosis = $request->diagnosis;
            $examination->doctor_id = auth()->id();
        }

        $examination->save();

        return redirect()->route('examinations.index')->with('success', 'New examination created successfully!');
    }

    public function formExamination($id)
    {
        $examination = Examination::with('patient')->findOrFail($id);

        if (!in_array(Auth::user()->role, ['perawat', 'dokter'])) {
            abort(403, 'Unauthorized');
        }

        return view('examinations.edit', compact('examination'));
    }

    public function updateExamination(Request $request, $id)
    {
        $examination = Examination::findOrFail($id);
        $userRole = auth()->user()->role;

        if ($userRole == 'perawat') {
            $request->validate([
                'weight' => 'required|numeric|min:1|max:500',
                'blood_pressure' => 'required|string|max:20',
            ]);
            
            $examination->weight = $request->weight;
            $examination->blood_pressure = $request->blood_pressure;
            $examination->nurse_id = auth()->id();
        }

        if ($userRole == 'dokter') {
            $request->validate([
                'complaint' => 'required|string|max:1000',
                'diagnosis' => 'required|string|max:1000',
            ]);
            
            $examination->complaint = $request->complaint;
            $examination->diagnosis = $request->diagnosis;
            $examination->doctor_id = auth()->id();
        }

        $examination->updated_at = now();
        $examination->save();

        return redirect()->route('examinations.index')->with('success', 'Examination updated successfully!');
    }
}