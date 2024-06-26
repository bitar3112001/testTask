<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $table = 'task';
    protected $fillable=[
        'name',
        'deploy_date',
        'submit_date',
        'project_id',
        'description',
    ];
}
