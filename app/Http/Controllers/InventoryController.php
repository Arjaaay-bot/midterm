<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory; 
use App\Notifications\LowQuantityNotification;

class InventoryController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        Inventory::create($validatedData);

        return redirect()->route('material');
    }

    public function index()
    {
        $inventoryItems = Inventory::all();

        return view('admin.materials', ['inventoryItems' => $inventoryItems]);
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'amount' => 'required|string',
        ]);

        $inventoryItem = Inventory::find($id);

        $inventoryItem->name = $validatedData['name'];
        $inventoryItem->quantity = $validatedData['quantity'];
        $inventoryItem->amount = $validatedData['amount'];
        $inventoryItem->save();

        return redirect('/material'); 
    }

    public function delete(Request $request, $id) {
        try {
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

    public function reduceQuantity(Request $request, $id)
{
    $inventoryItem = Inventory::findOrFail($id);

    $reduceQuantity = $request->input('reduceQuantity', 1);

    if ($inventoryItem->quantity >= $reduceQuantity) {
        $newQuantity = $inventoryItem->quantity - $reduceQuantity;
        $inventoryItem->update(['quantity' => $newQuantity]);

        if ($newQuantity < 10) {
            // Send notification
            $inventoryItem->notify(new LowQuantityNotification());
        }

        return response()->json(['success' => true, 'newQuantity' => $newQuantity, 'warning' => $newQuantity <= 20]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid quantity to reduce.']);
}

public function getMaterialNames()
    {
        $materialNames = Inventory::pluck('name');
        return response()->json($materialNames);
    }


}
