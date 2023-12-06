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
    $existingMaterial = Inventory::where('name', $materialRequest->name)->first();

    if ($existingMaterial) {
        $existingMaterial->increment('quantity', $materialRequest->quantity);
        $existingMaterial->update([
            'amount' => $materialRequest->amount, 
        ]);
    } else {
        Inventory::create([
            'name' => $materialRequest->name,
            'quantity' => $materialRequest->quantity,
            'amount' => $materialRequest->amount,
        ]);
    }
    $materialRequest->update(['status' => 'accepted']);
    return redirect()->route('admin.requests')->with('success', 'Material request accepted');
}
    public function decline($id)
    {
        $materialRequest = MaterialRequest::findOrFail($id);
        $materialRequest->update(['status' => 'declined']);
        return redirect()->route('admin.requests')->with('success', 'Material request declined');
    }
}
