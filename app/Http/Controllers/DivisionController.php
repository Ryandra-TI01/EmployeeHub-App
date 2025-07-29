<?php

namespace App\Http\Controllers;

use App\Http\Resources\DivisionResource;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        $query = Division::query();

        if ($request->filled('name')) {
            $query->where('name', 'ILIKE', '%' . $request->name . '%');
            // Use parameter binding for safety
            // $query->where('name', 'ILIKE', '%' . $request->name . '%');
            $query->where('name', 'ILIKE', '%' . $request->input('name') . '%');
        }

        $divisions = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Divisions retrieved successfully',
            'data' => ['divisions' => DivisionResource::collection($divisions)],
            'pagination' => [
                'current_page' => $divisions->currentPage(),
                'last_page' => $divisions->lastPage(),
                'per_page' => $divisions->perPage(),
                'total' => $divisions->total()
            ]
        ]);
    }

}
