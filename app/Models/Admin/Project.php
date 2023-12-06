<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name', 'project_description', 'client', 'project_start_date', 'project_end_date', 'status',
    ];

 
}
