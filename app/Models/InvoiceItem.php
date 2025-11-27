<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'fee_type_id', 'amount'];

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

