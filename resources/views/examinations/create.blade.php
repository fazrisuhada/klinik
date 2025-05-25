@extends('layouts.app')

@section('title', 'Form Examination')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-3">
                <i class="fas fa-plus text-success"></i> Form Examination
            </h2>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        @if(auth()->user()->role == 'perawat')
                            <i class="fas fa-notes-medical text-success"></i> Form Examination Nurse
                        @else
                            <i class="fas fa-user-md text-primary"></i> Form Examination Doctor
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

                    <form action="{{ route('examinations.store', $patient->id) }}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Patient Name</label>
                                <input type="text" class="form-control bg-light" value="{{ $patient->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Examination Date</label>
                                <input type="text" class="form-control bg-light" value="{{ now()->format('d/m/Y') }}" readonly>
                            </div>
                        </div>

                        @if($patient->phone)
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" class="form-control bg-light" value="{{ $patient->phone }}" readonly>
                            </div>
                        </div>
                        @endif

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
                                           value="{{ old('weight') }}" 
                                           placeholder="Enter patient weight"
                                           step="0.1"
                                           min="1"
                                           max="500"
                                           required>
                                    @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Enter weight in kilograms (1-500 kg)</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="blood_pressure" class="form-label">Blood Pressure <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           id="blood_pressure"
                                           name="blood_pressure" 
                                           class="form-control @error('blood_pressure') is-invalid @enderror" 
                                           value="{{ old('blood_pressure') }}" 
                                           placeholder="e.g., 120/80"
                                           required>
                                    @error('blood_pressure')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Format: systolic/diastolic (e.g., 120/80)</div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Note:</strong> Doctor can add complaint and diagnosis later by editing this examination.
                        </div>
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
                                              required>{{ old('complaint') }}</textarea>
                                    @error('complaint')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Describe the patient's reported complaint</div>
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
                                              required>{{ old('diagnosis') }}</textarea>
                                    @error('diagnosis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Provide medical diagnosis based on examination</div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Note:</strong> Nurse can add weight and blood pressure data later by editing this examination.
                        </div>
                        @endif

                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('examinations.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to List
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Create Examination
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