<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMaterial extends Model
{
    protected $table = 'requests';
    protected $fillable = ['name', 'quantity', 'amount'];

}
