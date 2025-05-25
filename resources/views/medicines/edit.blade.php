@extends('layouts.app')

@section('title', 'Edit Medicine')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-edit"></i> Edit Medicine
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="medicine_name" class="form-label">
                                <i class="fas fa-pills text-primary"></i> Medicine Name
                            </label>
                            <input type="text" name="medicine_name" id="medicine_name"
                                   class="form-control @error('medicine_name') is-invalid @enderror"
                                   value="{{ old('medicine_name', $medicine->medicine_name) }}" 
                                   placeholder="Enter medicine name"
                                   required>
                            @error('medicine_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">
                                <i class="fas fa-tags text-info"></i> Medicine Type
                            </label>
                            <select name="type" id="type" 
                                    class="form-select @error('type') is-invalid @enderror" required>
                                <option value="">Choose Medicine Type</option>
                                <option value="Tablet" {{ old('type', $medicine->type) == 'Tablet' ? 'selected' : '' }}>
                                    Tablet
                                </option>
                                <option value="Capsule" {{ old('type', $medicine->type) == 'Capsule' ? 'selected' : '' }}>
                                    Capsule
                                </option>
                                <option value="Syrup" {{ old('type', $medicine->type) == 'Syrup' ? 'selected' : '' }}>
                                    Syrup
                                </option>
                                <option value="Injection" {{ old('type', $medicine->type) == 'Injection' ? 'selected' : '' }}>
                                    Injection
                                </option>
                                <option value="Cream" {{ old('type', $medicine->type) == 'Cream' ? 'selected' : '' }}>
                                    Cream
                                </option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">
                                        <i class="fas fa-boxes text-success"></i> Stock
                                    </label>
                                    <input type="number" name="stock" id="stock" min="0"
                                           class="form-control @error('stock') is-invalid @enderror"
                                           value="{{ old('stock', $medicine->stock) }}" 
                                           placeholder="Enter stock quantity"
                                           required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle"></i> Enter the stock quantity
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">
                                        <i class="fas fa-money-bill text-warning"></i> Price per Unit
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="price" id="price" min="0" step="0.01"
                                               class="form-control @error('price') is-invalid @enderror"
                                               value="{{ old('price', $medicine->price) }}" 
                                               placeholder="0.00"
                                               required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle"></i> Price per single unit/piece
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-file-medical-alt text-secondary"></i> Description
                                <span class="text-muted">(Optional)</span>
                            </label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Enter medicine description, usage instructions, or notes...">{{ old('description', $medicine->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="expired_date" class="form-label">
                                <i class="fas fa-calendar-alt text-danger"></i> Expiry Date
                                <span class="text-muted">(Optional)</span>
                            </label>
                            <input type="date" name="expired_date" id="expired_date"
                                   class="form-control @error('expired_date') is-invalid @enderror"
                                   value="{{ old('expired_date', $medicine->expired_date ? \Carbon\Carbon::parse($medicine->expired_date)->format('Y-m-d') : '') }}" 
                                   min="{{ date('Y-m-d') }}">
                            @error('expired_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle"></i> Leave empty if no expiry date
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('medicines.index') }}" class="btn btn-outline-secondary btn-md">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <div>
                                <button type="submit" class="btn btn-warning btn-md">
                                    <i class="fas fa-save"></i> Update Medicine
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection