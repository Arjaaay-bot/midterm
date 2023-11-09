<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory; 

class InventoryController extends Controller
{

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        // Create a new inventory item
        Inventory::create($validatedData);

        return redirect()->route('material'); // Redirect back to the materials page
    }

    public function index()
    {
        // Retrieve all inventory items from the database
        $inventoryItems = Inventory::all();

        return view('admin.materials', ['inventoryItems' => $inventoryItems]);
    }
    
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'quantity' => 'required|integer',
        'amount' => 'required|string',
    ]);

    // Find the inventory item by ID
    $inventoryItem = Inventory::find($id);

    if (!$inventoryItem) {
        // Handle the case where the item is not found (e.g., show an error message)
    }

    // Update the item's attributes
    $inventoryItem->name = $validatedData['name'];
    $inventoryItem->quantity = $validatedData['quantity'];
    $inventoryItem->amount = $validatedData['amount'];
    $inventoryItem->save();

    return redirect('/material'); 
}

    public function delete(Request $request, $id) {
        try {
            // Find the item by ID and delete it
            $item = Inventory::find($id);
            if ($item) {
                $item->delete();
                return response()->json(['message' => 'Item deleted successfully']);
            } else {
                return response()->json(['error' => 'Item not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the item']);
        }
    }

}
