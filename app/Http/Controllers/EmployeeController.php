<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with('division');

        if ($request->filled('name')) {
            $query->where('name', 'ILIKE', '%' . $request->name . '%');
        }

        if ($request->filled('division_id')) {
            $query->where('division_id', (string) $request->division_id);
        }

        $employees = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Employees retrieved successfully',
            'data' => ['employees' => EmployeeResource::collection($employees)],
            'pagination' => [
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total()
            ]
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'division_id' => 'required|exists:divisions,id',
            'position' => 'required|string|max:255',
        ]);

        $path = $request->file('image')?->store('employees', 'public');

        Employee::create([
            'image' => $path,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'division_id' => $validated['division_id'],
            'position' => $validated['position'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee created successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string',
            'phone' => 'required|string',
            'division_id' => 'required|exists:divisions,id',
            'position' => 'required|string',
        ]);

        $path = $request->file('image')?->store('employees', 'public');

        $employee->update([
            'image' => $path ? asset('storage/' . $path) : $employee->image,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'division_id' => $validated['division_id'],
            'position' => $validated['position'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee updated'
        ]);
    }
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee deleted successfully'
        ]);
    }
}
