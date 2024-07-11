<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Source extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'source_id';

    protected $fillable = [
        'name',
        'description',
        'type',
    ];

    public function revenues()
    {
        return $this->hasMany(Revenue::class, 'source_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'source_id');
    }
}
