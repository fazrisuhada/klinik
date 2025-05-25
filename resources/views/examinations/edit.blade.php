@extends('layouts.app')

@section('title', 'Form Examination')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-3">
                <i class="fas fa-edit text-primary"></i> Form Examination
            </h2>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        @if(auth()->user()->role == 'perawat')
                        <i class="fas fa-notes-medical text-success"></i> Nurse Examination Form
                        @else
                        <i class="fas fa-user-md text-primary"></i> Doctor Examination Form
                        @endif
                    </h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h6>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ $examination->id ? route('examinations.updateExamination', $examination->id) : route('examinations.store') }}" method="POST">
                        @csrf
                        @if($examination->id)
                        @method('PUT')
                        @endif

                        @if(!$examination->id)
                        <input type="hidden" name="patient_id" value="{{ $examination->patient->id }}">
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Patient Name</label>
                                <input type="text" class="form-control bg-light" value="{{ $examination->patient->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Examination Date</label>
                                <input type="text" class="form-control bg-light" value="{{ \Carbon\Carbon::parse($examination->date ?? now())->format('d/m/Y') }}" readonly>
                            </div>
                        </div>

                        <hr>

                        @if(auth()->user()->role == 'perawat')
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-success mb-3">
                                    <i class="fas fa-notes-medical"></i> Nurse Assessment
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="weight" class="form-label">Weight (kg) <span class="text-danger">*</span></label>
                                    <input type="number"
                                        id="weight"
                                        name="weight"
                                        class="form-control @error('weight') is-invalid @enderror"
                                        value="{{ old('weight', $examination->weight) }}"
                                        placeholder="Enter patient weight"
                                        step="0.1"
                                        min="1"
                                        max="500"
                                        required>
                                    @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="blood_pressure" class="form-label">Blood Pressure <span class="text-danger">*</span></label>
                                    <input type="text"
                                        id="blood_pressure"
                                        name="blood_pressure"
                                        class="form-control @error('blood_pressure') is-invalid @enderror"
                                        value="{{ old('blood_pressure', $examination->blood_pressure) }}"
                                        placeholder="e.g., 120/80"
                                        required>
                                    @error('blood_pressure')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Format: systolic/diastolic (e.g., 120/80)</div>
                                </div>
                            </div>
                        </div>

                        @if($examination->complaint || $examination->diagnosis)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-user-md"></i> Doctor Assessment (Read Only)
                                </h6>
                            </div>
                            @if($examination->complaint)
                            <div class="col-md-6">
                                <label class="form-label">Complaint</label>
                                <textarea class="form-control bg-light" rows="3" readonly>{{ $examination->complaint }}</textarea>
                            </div>
                            @endif
                            @if($examination->diagnosis)
                            <div class="col-md-6">
                                <label class="form-label">Diagnosis</label>
                                <textarea class="form-control bg-light" rows="3" readonly>{{ $examination->diagnosis }}</textarea>
                            </div>
                            @endif
                        </div>
                        @endif
                        @endif

                        @if(auth()->user()->role == 'dokter')
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-user-md"></i> Doctor Assessment
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="complaint" class="form-label">Complaint <span class="text-danger">*</span></label>
                                    <textarea id="complaint"
                                        name="complaint"
                                        class="form-control @error('complaint') is-invalid @enderror"
                                        rows="4"
                                        placeholder="Describe patient complaint..."
                                        required>{{ old('complaint', $examination->complaint) }}</textarea>
                                    @error('complaint')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="diagnosis" class="form-label">Diagnosis <span class="text-danger">*</span></label>
                                    <textarea id="diagnosis"
                                        name="diagnosis"
                                        class="form-control @error('diagnosis') is-invalid @enderror"
                                        rows="4"
                                        placeholder="Provide diagnosis..."
                                        required>{{ old('diagnosis', $examination->diagnosis) }}</textarea>
                                    @error('diagnosis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if($examination->weight || $examination->blood_pressure)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-success mb-3">
                                    <i class="fas fa-notes-medical"></i> Nurse Assessment (Read Only)
                                </h6>
                            </div>
                            @if($examination->weight)
                            <div class="col-md-6">
                                <label class="form-label">Weight</label>
                                <input type="text" class="form-control bg-light" value="{{ $examination->weight }} kg" readonly>
                            </div>
                            @endif
                            @if($examination->blood_pressure)
                            <div class="col-md-6">
                                <label class="form-label">Blood Pressure</label>
                                <input type="text" class="form-control bg-light" value="{{ $examination->blood_pressure }}" readonly>
                            </div>
                            @endif
                        </div>
                        @endif
                        @endif

                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('examinations.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to List
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> {{ $examination->id ? 'Update Examination' : 'Create Examination' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection