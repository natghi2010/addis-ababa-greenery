<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ["created_at", "updated_at"];

    protected $appends = ['remaining_days_until_start_date', 'remaining_days_until_end_date'];

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }


    // public function getStartDateAttribute()
    // {
    //     return Carbon::parse($this->attributes['start_date'])->format('d-m-Y');
    // }

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class)->select('id', 'title');
    }

    public function getStartDateAttribute($value)
    {
        return (new Carbon($value))->format('D d M Y');
    }

    public function getEndDateAttribute($value)
    {
        return (new Carbon($value))->format('D d M Y');
    }

    public function stakeHolders()
    {
        return $this->hasMany(StakeHolder::class);
    }

    public function teamLeader()
    {
        return $this->belongsTo(User::class, "team_leader_id", 'id')->select("id", "name");
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function challenges()
    {
        return $this->hasMany(Report::class)->where("answer", '!=', null);
    }

    public function qrCode()
    {
        return $this->belongsTo(QrCode::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function subcity()
    {
        return $this->belongsTo(Subcity::class)->select('id', 'name');
    }

    public function getRemainingDaysUntilStartDateAttribute()
    {

        $diffDays =  Carbon::now()->diffInDays(Carbon::parse($this->attributes['start_date']));

        return Carbon::parse($this->attributes['end_date']) > Carbon::now() ? $diffDays : $diffDays * -1;
    }

    public function getRemainingDaysUntilEndDateAttribute()
    {
        $diffDays =  Carbon::now()->diffInDays(Carbon::parse($this->attributes['end_date']));

        return Carbon::parse($this->attributes['end_date']) > Carbon::now() ? $diffDays : $diffDays * -1;
    }
}
