<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Material;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $query = Facility::query();

        // Search by name, address (which may include city), or material
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'LIKE', "%$search%")
                    ->orWhere('street_address', 'LIKE', "%$search%")
                    ->orWhereHas('materials', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        // Filter by material
        $material_id = $request->input('material');
        if ($material_id) {
            $query->whereHas('materials', function ($q) use ($material_id) {
                $q->where('materials.id', $material_id);
            });
        }

        // Sort by last_update_date
        $sort = $request->input('sort', 'desc');
        $query->orderBy('last_update_date', $sort);

        $facilities = $query->paginate(5)->withQueryString();

        $materials = Material::all();

        return view('facilities.index', compact('facilities', 'materials'));
    }

    public function create()
    {
        $materials = Material::all();
        return view('facilities.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'last_update_date' => 'required|date',
            'street_address' => 'required|string|max:255',
            'materials' => 'array',
            'materials.*' => 'exists:materials,id',
        ]);

        $facility = Facility::create($validated);

        // Safely attach only valid IDs
        if ($request->filled('materials')) {
            $facility->materials()->attach($request->materials);
        }

        return redirect()->route('facilities.index')
            ->with('success', 'Facility added.');
    }


    public function show(Facility $facility)
    {
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        $materials = Material::all();
        return view('facilities.edit', compact('facility', 'materials'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'last_update_date' => 'required|date',
            'street_address' => 'required|string|max:255',
            'materials' => 'array',
        ]);

        $facility->update($validated);
        $facility->materials()->sync($request->input('materials', []));

        return redirect()->route('facilities.index')->with('success', 'Facility updated.');
    }

    public function destroy(Facility $facility)
    {
        $facility->materials()->detach();
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility deleted.');
    }

    public function export(Request $request)
    {
        $query = Facility::query();

        // Apply same filters/search/sort as index
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'LIKE', "%$search%")
                    ->orWhere('street_address', 'LIKE', "%$search%")
                    ->orWhereHas('materials', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        $material_id = $request->input('material');
        if ($material_id) {
            $query->whereHas('materials', function ($q) use ($material_id) {
                $q->where('materials.id', $material_id);
            });
        }

        $sort = $request->input('sort', 'desc');
        $query->orderBy('last_update_date', $sort);

        $facilities = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="facilities.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['ID', 'Business Name', 'Last Update Date', 'Street Address', 'Materials'];

        $callback = function () use ($facilities, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($facilities as $facility) {
                $materialsList = $facility->materials->pluck('name')->implode(', ');
                fputcsv($file, [
                    $facility->id,
                    $facility->business_name,
                    $facility->last_update_date,
                    $facility->street_address,
                    $materialsList,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
