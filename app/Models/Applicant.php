<?php

namespace App\Models;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_register',
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'alamat',
        'domisili',
        'no_hp',
        'no_hp_darurat',
        'tinggi_badan',
        'berat_badan',
        'kantor_tujuan',
        'role',
        'email',
        'path',
        'password',
    ];

    public function magang()
    {
        return $this->hasOne(Magang::class);
    }

    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }
}
