<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function projectType(){
        return $this->belongsTo(ProjectType::class)->select('id', 'title');
    }

    public function stakeHolders()
    {
        return $this->hasMany(StakeHolder::class);
    }

    public function teamLeader()
    {
        return $this->belongsTo(User::class, "team_leader_id", 'id');
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}
