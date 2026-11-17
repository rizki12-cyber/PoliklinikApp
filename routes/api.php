<?php

use App\Models\Booking;

Route::get('/booking/{code}', function ($code) {
    $booking = Booking::where('booking_code', $code)->with('doctor')->first();
    if ($booking) {
        return response()->json(['success' => true, 'booking' => $booking]);
    }
    return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
});

Route::post('/booking/{code}/checkin', function ($code) {
    $booking = Booking::where('booking_code', $code)->first();
    if ($booking) {
        $booking->update(['status' => 'checked_in', 'checkin_time' => now()]);
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 404);
});

Route::post('/booking/{code}/cancel', function ($code) {
    $booking = Booking::where('booking_code', $code)->first();
    if ($booking) {
        $booking->update(['status' => 'cancelled']);
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 404);
});