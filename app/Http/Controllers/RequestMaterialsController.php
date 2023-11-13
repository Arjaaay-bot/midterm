<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestMaterial;
use App\Models\Inventory; 

class RequestMaterialsController extends Controller
{
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        $validatedData['status'] = 'waiting for approval';
    
        $material = RequestMaterial::create($validatedData);
    
        if (!$material) {
            return response()->json(['error' => 'Failed to save material'], 500);
        }
    
        return response()->json(['message' => 'Material saved successfully']);
    }

    public function list()
    {
        $materials = RequestMaterial::all();

        return view('staff.requestmaterials', compact('materials'));
        return view('staff.materials', compact('materials'));
    }

    public function index()
    {
        $inventoryItems = Inventory::all();

        return view('staff.materials', ['inventoryItems' => $inventoryItems]);
    }

    public function destroy(RequestMaterial $material)
    {
        $material->delete();

        return response()->json(['message' => 'Material deleted successfully']);
    }

    public function update(Request $request, RequestMaterial $material)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        $material->update($validatedData);

        return response()->json(['message' => 'Material updated successfully']);
    }

        public function getTotalRequests()
    {
        $totalRequests = RequestMaterial::count();
        return response()->json(['totalRequests' => $totalRequests]);
    }


    public function getChartStatusData()
    {
        $waiting = RequestMaterial::where('status', 'waiting for approval')->count();
        $accepted = RequestMaterial::where('status', 'accepted')->count();
        $declined = RequestMaterial::where('status', 'declined')->count();
    
        return response()->json(['waiting' => $waiting, 'accepted' => $accepted, 'declined' => $declined]);
    }

}
