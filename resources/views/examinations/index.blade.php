@extends('layouts.app')

@section('title', 'Examinations - Management Clinic')

@section('content')
<div class="container">
    <h2 class="mb-3"><i class="fas fa-stethoscope text-primary"></i> Examinations</h2>
    <p class="text-muted mb-4">Manage examination data</p>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> Examinations
                <span class="badge bg-secondary ms-2">{{ $patients->total() }} Total</span>
            </h5>
        </div>
        <div class="card-body">
            @if($patients->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Patient Name</th>
                            <th>Weight (kg)</th>
                            <th>Blood Pressure</th>
                            <th>Complaint</th>
                            <th>Diagnosis</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $index => $patient)
                        @php
                            $examination = $patient->examinations->first(); // Ambil pemeriksaan terakhir
                        @endphp
                        <tr>
                            <td>{{ $patients->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $patient->name ?? '-' }}</strong>
                                @if($patient->phone)
                                    <br><small class="text-muted">{{ $patient->phone }}</small>
                                @endif
                            </td>
                            <td>
                                @if($examination && $examination->weight)
                                    <span class="badge bg-success">{{ $examination->weight }} kg</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($examination && $examination->blood_pressure)
                                    <span class="badge bg-info">{{ $examination->blood_pressure }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($examination && $examination->complaint)
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $examination->complaint }}">
                                        {{ $examination->complaint }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($examination && $examination->diagnosis)
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $examination->diagnosis }}">
                                        {{ $examination->diagnosis }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($examination)
                                    <small class="text-muted">
                                        {{ $examination->updated_at->format('d/m/Y H:i') }}
                                    </small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($examination)
                                <div class="btn-group" role="group">
                                    @if(auth()->user()->role == 'perawat')
                                    <a href="{{ route('examinations.form', $examination->id) }}" class="btn btn-sm btn-outline-success" title="Edit as Nurse">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @endif
                                    
                                    @if(auth()->user()->role == 'dokter')
                                    <a href="{{ route('examinations.form', $examination->id) }}" class="btn btn-sm btn-outline-primary" title="Edit as Doctor">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @endif
                                </div>
                                @else
                                <div class="btn-group" role="group">
                                    @if(auth()->user()->role == 'perawat')
                                    <a href="{{ route('examinations.create', $patient->id) }}" class="btn btn-sm btn-success" title="Add Examination as Nurse">
                                        <i class="fas fa-plus"></i> Add Examination
                                    </a>
                                    @endif
                                    
                                    @if(auth()->user()->role == 'dokter')
                                    <a href="{{ route('examinations.create', $patient->id) }}" class="btn btn-sm btn-primary" title="Add Examination as Doctor">
                                        <i class="fas fa-plus"></i> Add Examination
                                    </a>
                                    @endif
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <small class="text-muted">
                        Showing {{ $patients->firstItem() }} to {{ $patients->lastItem() }}
                        of {{ $patients->total() }} results
                    </small>
                </div>
                <div>
                    {{ $patients->links() }}
                </div>
            </div>
            @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> No examination data found.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection