<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;
    protected $fillable = ['application_id', 'student_id', 'admitted_by', 'admitted_at'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
