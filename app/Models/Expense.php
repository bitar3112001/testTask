<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'expense_id';

    protected $fillable = [
        'employee_id',
        'source_id',
        'user_id',
        'amount',
        'description',
        'date',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
