<?php
namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Medicine;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        $patients = Patient::count();
        $medicines = Medicine::count();
        $examinations = Examination::count();
        
        return view('dashboard', compact('patients', 'medicines', 'examinations'));
    }
}