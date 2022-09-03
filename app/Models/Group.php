<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];

    public function students()
    {
        return $this->belongsToMany(User::class, 'group_student', 'group_id', 'student_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
