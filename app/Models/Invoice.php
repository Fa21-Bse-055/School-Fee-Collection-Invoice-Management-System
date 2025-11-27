<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_no', 'student_id', 'due_date', 'total_amount', 'status'];

        protected static function booted()
    {
        static::creating(function ($invoice) {
            if (empty($invoice->invoice_no)) {
                $invoice->invoice_no = 'INV-' . time(); // or use a better sequence
            }
        });
    }
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
{
    return $this->hasMany(Payment::class);
}

}

