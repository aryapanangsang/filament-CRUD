<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'applicant_id',
        'company_id',
        'insurance_number'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function magang()
    {
        return $this->belongsTo(Magang::class);
    }
}
