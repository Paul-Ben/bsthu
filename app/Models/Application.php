<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_no',
        'full_name',
        'email',
        'phone',
        'gender',
        'dob',
        'state',
        'lga',
        'country',
        'program_applied_id',
        'status',
        'document_path'
    ];

    protected $casts = [
        'dob' => 'date'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'program_applied_id');
    }

    public function admission()
    {
        return $this->hasOne(Admission::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
