@extends('layouts.app')

@section('title', 'Add New Medicine')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle"></i> Add New Medicine
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

                    <form action="{{ route('medicines.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="medicine_name" class="form-label">
                                <i class="fas fa-pills text-primary"></i> Medicine Name
                            </label>
                            <input type="text" name="medicine_name" id="medicine_name"
                                   class="form-control @error('medicine_name') is-invalid @enderror"
                                   value="{{ old('medicine_name') }}" 
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
                                <option value="Tablet" {{ old('type') == 'Tablet' ? 'selected' : '' }}>
                                    <i class="fas fa-circle"></i> Tablet
                                </option>
                                <option value="Capsule" {{ old('type') == 'Capsule' ? 'selected' : '' }}>
                                    <i class="fas fa-capsules"></i> Capsule
                                </option>
                                <option value="Syrup" {{ old('type') == 'Syrup' ? 'selected' : '' }}>
                                    <i class="fas fa-flask"></i> Syrup
                                </option>
                                <option value="Injection" {{ old('type') == 'Injection' ? 'selected' : '' }}>
                                    <i class="fas fa-syringe"></i> Injection
                                </option>
                                <option value="Cream" {{ old('type') == 'Cream' ? 'selected' : '' }}>
                                    <i class="fas fa-hand-holding-medical"></i> Cream
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
                                        <i class="fas fa-boxes text-success"></i> Initial Stock
                                    </label>
                                    <input type="number" name="stock" id="stock" min="0"
                                           class="form-control @error('stock') is-invalid @enderror"
                                           value="{{ old('stock') }}" 
                                           placeholder="Enter stock quantity"
                                           required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle"></i> Enter the initial stock quantity
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
                                               value="{{ old('price') }}" 
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
                                      placeholder="Enter medicine description, usage instructions, or notes...">{{ old('description') }}</textarea>
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
                                   value="{{ old('expired_date') }}" 
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
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fas fa-save"></i> Save Medicine
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