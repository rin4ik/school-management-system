<?php
namespace App\Http\Traits;

use App\Models\Grade;
use App\Models\Group;

trait Student {
    public function getGroupAttribute()
    {
        if (!array_key_exists('group', $this->relations)) $this->loadGroup();

        return $this->getRelation('group');
    }

    public function loadGroup()
    {
        $this->setRelation('group', $this->groups->first());
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_student', 'student_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }
    public function getAverageAttribute()
    {
        return $this->grades->avg('mark');
    }
}