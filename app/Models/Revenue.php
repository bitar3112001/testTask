<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Revenue extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'revenue_id';

    protected $fillable = [
        'employee_id',
        'source_id',
        'user_id',
        'amount',
        'paid_amount',
        'rest_amount',
        'total_installments',
        'installment_period',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'revenue_id');
    }
}
