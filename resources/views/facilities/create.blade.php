@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-control mt-4">
                    <div class="text-end">
                        <a class="btn btn-primary" href="{{ route('facilities.index') }}">List</a>
                    </div>
                    <form method="POST" action="{{ route('facilities.store') }}">
                        @csrf

                        <div class="mt-5">
                            <div class="form-group">
                                <label>Business Name: </label>
                                <input type="text" name="business_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Last Update Date:</label>
                                <input type="date" name="last_update_date" class="form-control"required>
                            </div>
                            <div class="form-group">
                                <label>Street Address: </label>
                                <input type="text" name="street_address" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Materials</label>
                                <div class="card bg-light p-3">
                                    <div class="row">
                                        @foreach ($materials as $material)
                                            <div class="col-md-4">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" name="materials[]" value="{{ $material->id }}"
                                                        class="form-check-input" id="material_{{ $material->id }}">
                                                    <label class="form-check-label" for="material_{{ $material->id }}">
                                                        {{ $material->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('materials')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary form-control">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
