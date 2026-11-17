<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'booking_code','patient_name', 'phone', 'email', 'doctor_id', 
        'booking_date', 'booking_time', 'complaint', 'status', 'notes'
    ];
    
    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime',
    ];
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning text-dark">Pending</span>',
            'confirmed' => '<span class="badge bg-success">Confirmed</span>',
            'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
            'completed' => '<span class="badge bg-info">Completed</span>',
        ];
        
        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }
}