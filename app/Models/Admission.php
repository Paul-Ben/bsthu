<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'status',
        'decision_date',
        'offer_date',
        'program_id',
        'student_id'
    ];

    protected $casts = [
        'decision_date' => 'datetime',
        'offer_date' => 'datetime'
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'program_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
// }    protected $fillable = ['application_id', 'student_id', 'admitted_by', 'admitted_at'];

}
