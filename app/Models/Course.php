<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'title', 'credit_load', 'level', 'semester', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function registrations()
    {
        return $this->belongsToMany(Registration::class, 'registration_course');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
