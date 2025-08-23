@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4 mt-4">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center mb-0">{{ $facility->business_name }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <p><strong>Last Update:</strong> {{ $facility->last_update_date }}</p>
                                </div>
                                <div>
                                    <p><strong>Address:</strong> {{ $facility->street_address }}</p>
                                </div>
                                <div>
                                    <p><strong>Materials:</strong> {{ $facility->materials->pluck('name')->implode(', ') }}
                                    </p>
                                </div>
                            </div>
                            <h5 class="card-title text-lg font-bold mb-3">📍 Location</h5>
                            <div class="overflow-hidden rounded-xl shadow-md">
                                <iframe width="100%" height="300" style="border:0;" loading="lazy" allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade"
                                    src="https://www.google.com/maps/embed/v1/place?key={{ config('services.google.maps_api_key') }}&q={{ urlencode($facility->street_address) }}"
                                    class="rounded-lg">
                                </iframe>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Back to List</a>
                        <a href="{{ route('facilities.edit', $facility) }}" class="btn btn-primary">Edit Facility</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
