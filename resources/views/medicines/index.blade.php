@extends('layouts.app')

@section('title', 'Medicine Management')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-pills text-primary"></i> Medicine Management
                    </h2>
                    <p class="text-muted mb-0">Manage medicine inventory</p>
                </div>
                <div>
                    @if(auth()->user()->role === 'apoteker')
                        <a href="{{ route('medicines.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Medicine
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Medicine List
                        <span class="badge bg-secondary ms-2">{{ $medicines->count() }} Items</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($medicines->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Medicine Name</th>
                                    <th>Type</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medicines as $medicine)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $medicine->medicine_name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $medicine->type }}</span>
                                    </td>
                                    <td>
                                        @if($medicine->stock <= 10)
                                            <span class="badge bg-danger">
                                                <i class="fas fa-exclamation-triangle"></i> {{ $medicine->stock }}
                                            </span>
                                        @elseif($medicine->stock <= 50)
                                            <span class="badge bg-warning text-dark">{{ $medicine->stock }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $medicine->stock }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($medicine->price, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('medicines.show', $medicine->id) }}"
                                                class="btn btn-sm btn-outline-info"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if(auth()->user()->role === 'apoteker')
                                                <a href="{{ route('medicines.edit', $medicine->id) }}"
                                                    class="btn btn-sm btn-outline-warning"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $medicine->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    title="Edit not available for your role"
                                                    disabled>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    title="Delete not available for your role"
                                                    disabled>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>

                                        @if(auth()->user()->role === 'apoteker')
                                            <div class="modal fade" id="deleteModal{{ $medicine->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                <i class="fas fa-exclamation-triangle text-danger"></i>
                                                                Confirm Delete
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this medicine?</p>
                                                            <div class="alert alert-warning">
                                                                <strong>{{ $medicine->medicine_name }}</strong><br>
                                                                <small>Type: {{ $medicine->type }} | Stock: {{ $medicine->stock }}</small>
                                                            </div>
                                                            <p class="text-danger">
                                                                <small>
                                                                    <i class="fas fa-warning"></i>
                                                                    This action cannot be undone!
                                                                </small>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle"></i> No medicines found. 
                        @if(auth()->user()->role === 'apoteker')
                            Start by adding your first medicine.
                        @else
                            Contact the pharmacist to add medicines.
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection