<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories'; // Set the table name
    protected $fillable = ['name', 'quantity', 'amount']; // Define the fillable fields
}
