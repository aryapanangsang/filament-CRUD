<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'company_id',
        'applicant_id',
        'join_date',
        'expired_date'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
