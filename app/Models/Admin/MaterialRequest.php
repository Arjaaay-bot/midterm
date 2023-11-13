<?php

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Inventory; 

class MaterialRequest extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = ['name', 'quantity', 'amount', 'status'];
    
}
