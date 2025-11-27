<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'invoice_id',
        'student_id',
        'amount',
        'method',
        'note'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
