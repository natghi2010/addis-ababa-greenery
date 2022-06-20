<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ["time","date","image"];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function getImageAttribute($value)
    {
        return 'data:image/png;base64,' . $value;

    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('D, d M Y');
    }

    public function getTimeAttribute(){
        return Carbon::parse($this->created_at)->format('h:i A');
    }
}
