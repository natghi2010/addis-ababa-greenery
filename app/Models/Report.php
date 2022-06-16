<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function getImageAttribute($value)
    {
        return 'data:image/png;base64,' . $value;
    }
}
