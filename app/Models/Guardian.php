<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;
    protected $table = 'guardians';
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsToMany(Student::class, 'guardian_students',  'guardian_id','student_id');
    }
}
