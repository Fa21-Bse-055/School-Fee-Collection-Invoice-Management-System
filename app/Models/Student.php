<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['admission_no', 'name', 'class', 'email', 'phone', 'age'];

    protected static function booted()
{
    static::creating(function ($student) {
        if (empty($student->admission_no)) {
            $student->admission_no = 'ADM-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }
    });
}


    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
