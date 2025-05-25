<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::latest()->paginate(10);
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'apoteker') {
            abort(403, 'Unauthorized action.');
        }

        return view('medicines.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'apoteker') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'medicine_name' => 'required|string|max:255',
            'type' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        Medicine::create($request->all());
        return redirect()->route('medicines.index')->with('success', 'Medicine created successfully!');
    }

    public function show(Medicine $medicine)
    {
        return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        if (auth()->user()->role !== 'apoteker') {
            abort(403, 'Unauthorized action.');
        }

        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        if (auth()->user()->role !== 'apoteker') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'medicine_name' => 'required|string|max:255',
            'type' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        $medicine->update($request->all());
        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully!');
    }

    public function destroy(Medicine $medicine)
    {
        if (auth()->user()->role !== 'apoteker') {
            abort(403, 'Unauthorized action.');
        }
        
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully!');
    }
}
