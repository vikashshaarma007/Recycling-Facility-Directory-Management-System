@extends('layouts.app') <!-- Assume a basic layout exists -->

@section('content')
    <!-- Search and Filter Form -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-control mt-4">

                    <form method="GET" action="{{ route('facilities.index') }}">
                        <div>
                            <div class="text-end">
                                <input type="text" name="search"
                                    placeholder="Search by name, city (in address), or material"
                                    value="{{ request('search') }}">
                            </div>
                            <div class="form-group">
                                <select name="material">
                                    <option value="">All Materials</option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}"
                                            {{ request('material') == $material->id ? 'selected' : '' }}>
                                            {{ $material->name }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-primary">Filter</button>


                                <!-- Sort Links (preserving other params) -->
                                <a href="{{ route('facilities.index', array_merge(request()->query(), ['sort' => 'desc'])) }}"
                                    class=" btn btn-primary">Sort by
                                    Last Update
                                    DESC</a>
                                <a href="{{ route('facilities.index', array_merge(request()->query(), ['sort' => 'asc'])) }}"
                                    class=" btn btn-primary">Sort by ASC</a>

                                <!-- Export Button -->
                                <a href="{{ route('facilities.export', request()->query()) }}" id="exportBtn"
                                    class="btn btn-primary">
                                    Download CSV
                                </a>

                                <!-- Toast message -->
                                <div id="toast"
                                    class="hidden fixed bottom-10 right-10 bg-success text-white px-4 py-2 rounded shadow">
                                    ✅ Download started. Check your Downloads folder.
                                </div>
                            </div>

                        </div>
                    </form>

                    <!-- Paginated Table -->
                    <div class="text-end">
                        <a class="btn btn-primary" href="{{ route('facilities.create') }}">Add Facility</a>
                    </div>
                    <table border="1" cellpadding="5" class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Last Update</th>
                                <th>Materials</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $facility)
                                <tr>
                                    <td><a
                                            href="{{ route('facilities.show', $facility) }}">{{ $facility->business_name }}</a>
                                    </td>
                                    <td>{{ $facility->last_update_date }}</td>
                                    <td>{{ $facility->materials->pluck('name')->implode(', ') }}</td>
                                    <td>
                                        <a href="{{ route('facilities.edit', $facility) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('facilities.destroy', $facility) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this facility?')"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById("exportBtn").addEventListener("click", function(event) {
            event.preventDefault();
            window.location.href = this.href; // start download

            // show toast
            let toast = document.getElementById("toast");
            toast.classList.remove("hidden");

            // auto-hide after 3s
            setTimeout(() => toast.classList.add("hidden"), 3000);
        });
    </script>
    {{ $facilities->links() }}
@endsection
