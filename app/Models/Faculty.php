<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

     protected $fillable = ['name', 'college_id'];

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
