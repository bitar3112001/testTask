<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'revenue_id',
        'amount',
        'status',
        'date',
    ];

    public function revenue()
    {
        return $this->belongsTo(Revenue::class, 'revenue_id');
    }
}
