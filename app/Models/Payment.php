<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'reference', 'amount', 'payment_type', 'status', 'paid_at', 'response_data'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
