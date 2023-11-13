<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory; 

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

}
