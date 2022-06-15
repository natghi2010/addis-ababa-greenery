<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function milestones(){
        return $this->hasMany(Milestone::class);
    }

    public function stakeHolders(){
        return $this->hasMany(StakeHolder::class);
    }

    public function teamMembers(){
        return $this->hasMany(TeamMember::class);
    }
}
