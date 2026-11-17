<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'specialization', 'description', 'photo', 
        'email', 'phone', 'max_booking_per_day', 'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'max_booking_per_day' => 'integer',
    ];
    
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    public function getTodayBookingCountAttribute()
    {
        return $this->bookings()
            ->whereDate('booking_date', today())
            ->where('status', '!=', 'cancelled')
            ->count();
    }
    
    public function isAvailable($date, $time = null)
    {
        // Cek jadwal dokter
        $dayOfWeek = date('l', strtotime($date));
        $schedule = $this->schedules()
            ->where('day', $dayOfWeek)
            ->where('is_active', true)
            ->first();
            
        if (!$schedule) {
            return false;
        }
        
        // Cek limit booking
        $todayBookings = $this->bookings()
            ->whereDate('booking_date', $date)
            ->where('status', '!=', 'cancelled')
            ->count();
            
        if ($todayBookings >= $this->max_booking_per_day) {
            return false;
        }
        
        return true;
    }
}