<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'blood_pressure',
        'weight',
        'complaint',
        'diagnosis',
        'nurse_id',
        'doctor_id'
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }
}
