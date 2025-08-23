@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="text-end">
                        <a class="btn btn-primary" href="{{ route('facilities.index') }}">List</a>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('facilities.update', $facility) }}" class="needs-validation"
                            novalidate>
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="business_name" class="form-label">Business Name</label>
                                <input type="text" name="business_name" id="business_name"
                                    class="form-control @error('business_name') is-invalid @enderror"
                                    value="{{ old('business_name', $facility->business_name) }}" required>
                                @error('business_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="last_update_date" class="form-label">Last Update Date</label>
                                <input type="date" name="last_update_date" id="last_update_date"
                                    class="form-control @error('last_update_date') is-invalid @enderror"
                                    value="{{ old('last_update_date', $facility->last_update_date) }}" required>
                                @error('last_update_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="street_address" class="form-label">Street Address</label>
                                <input type="text" name="street_address" id="street_address"
                                    class="form-control @error('street_address') is-invalid @enderror"
                                    value="{{ old('street_address', $facility->street_address) }}" required>
                                @error('street_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Materials</label>
                                <div class="card bg-light p-3">
                                    <div class="row">
                                        @foreach ($materials as $material)
                                            <div class="col-md-4">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" name="materials[]" value="{{ $material->id }}"
                                                        class="form-check-input" id="material_{{ $material->id }}"
                                                        {{ in_array($material->id, old('materials', $facility->materials->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="material_{{ $material->id }}">{{ $material->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('materials')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary form-control">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Client-side validation script -->
    <script>
        (function() {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
