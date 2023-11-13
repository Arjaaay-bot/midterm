<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\MaterialRequest;
use App\Models\Inventory; 

class MaterialRequestController extends Controller
{
    
    public function index()
    {
        $materialRequests = MaterialRequest::all();
        return view('admin.requests', compact('materialRequests'));
    }

    public function accept($id)
{
    $materialRequest = MaterialRequest::findOrFail($id);

    // Check if the material already exists in the inventory
    $existingMaterial = Inventory::where('name', $materialRequest->name)->first();

    if ($existingMaterial) {
        // If the material exists, update the quantity and amount
        $existingMaterial->increment('quantity', $materialRequest->quantity);
        $existingMaterial->update([
            'amount' => $materialRequest->amount, // Decide whether to update the amount
        ]);
    } else {
        // If the material doesn't exist, add it to the inventory
        Inventory::create([
            'name' => $materialRequest->name,
            'quantity' => $materialRequest->quantity,
            'amount' => $materialRequest->amount,
        ]);
    }

    // Update the status of the material request
    $materialRequest->update(['status' => 'accepted']);

    return redirect()->route('admin.requests')->with('success', 'Material request accepted');
}



    public function decline($id)
    {
        // Logic to decline the material request
        // You may want to update the status column in the requests table

        // Example:
        $materialRequest = MaterialRequest::findOrFail($id);
        $materialRequest->update(['status' => 'declined']);

        return redirect()->route('admin.requests')->with('success', 'Material request declined');
    }
}
