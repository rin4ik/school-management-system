<?php
namespace App\Http\Traits;

use App\Models\Grade;

trait Teacher {
    public function marks()
    {
        return $this->hasMany(Grade::class, 'teacher_id');
    }
}