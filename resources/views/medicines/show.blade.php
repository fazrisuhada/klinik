@extends('layouts.app')

@section('title', 'Medicine Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle"></i> Medicine Details
                    </h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Medicine Name</dt>
                        <dd class="col-sm-8">{{ $medicine->medicine_name }}</dd>

                        <dt class="col-sm-4">Type</dt>
                        <dd class="col-sm-8">{{ $medicine->type }}</dd>

                        <dt class="col-sm-4">Stock</dt>
                        <dd class="col-sm-8">{{ $medicine->stock }}</dd>

                        <dt class="col-sm-4">Price</dt>
                        <dd class="col-sm-8">Rp{{ number_format($medicine->price, 2, ',', '.') }}</dd>

                        @if(!empty($medicine->description))
                        <dt class="col-sm-4">Description</dt>
                        <dd class="col-sm-8">{{ $medicine->description }}</dd>
                        @endif

                        @if(!empty($medicine->expiry_date))
                        <dt class="col-sm-4">Expiry Date</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($medicine->expiry_date)->format('d M Y') }}</dd>
                        @endif

                        <dt class="col-sm-4">Created At</dt>
                        <dd class="col-sm-8">{{ $medicine->created_at->format('d M Y H:i') }}</dd>

                        <dt class="col-sm-4">Updated At</dt>
                        <dd class="col-sm-8">{{ $medicine->updated_at->format('d M Y H:i') }}</dd>
                    </dl>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('medicines.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        @if(auth()->user()->role == 'apoteker')
                        <div>
                            <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this medicine?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection