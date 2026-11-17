<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Doctor;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('doctor');
        
        // Filter by date
        if ($request->has('date') && $request->date) {
            $query->whereDate('booking_date', $request->date);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by doctor
        if ($request->has('doctor_id') && $request->doctor_id) {
            $query->where('doctor_id', $request->doctor_id);
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->paginate(15);
        $doctors = Doctor::where('is_active', true)->get();
        
        return view('admin.bookings.index', compact('bookings', 'doctors'));
    }
    
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string|max:1000'
        ]);
        
        // Update status dan notes sekaligus
        $booking->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);
        
        // Send WhatsApp notification on status change
        if ($request->status == 'confirmed') {
            $this->sendConfirmationWhatsApp($booking);
        } elseif ($request->status == 'cancelled') {
            $this->sendCancellationWhatsApp($booking);
        }
        
        return redirect()->back()->with('success', 'Status booking berhasil diupdate');
    }
    
    public function show(Booking $booking)
    {
        $booking->load('doctor');
        return view('admin.bookings.show', compact('booking'));
    }
    
    public function destroy(Booking $booking)
    {
        $booking->delete();
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus');
    }
    
    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
        
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        return Excel::download(new BookingsExport($startDate, $endDate), 'bookings_' . date('Ymd_His') . '.xlsx');
    }
    
    private function sendConfirmationWhatsApp($booking)
    {
        $message = "Halo {$booking->patient_name},\n\n";
        $message .= "Booking Anda telah dikonfirmasi!\n\n";
        $message .= "Detail Booking:\n";
        $message .= "Dokter: {$booking->doctor->name}\n";
        $message .= "Tanggal: " . date('d F Y', strtotime($booking->booking_date)) . "\n";
        $message .= "Status: CONFIRMED ✓\n\n";
        $message .= "Silakan datang tepat waktu. Terima kasih.";
        
        // Log untuk testing (implementasikan WhatsApp API sesuai kebutuhan)
        \Log::info("WhatsApp Confirmation to {$booking->phone}: {$message}");
        
        return true;
    }
    
    private function sendCancellationWhatsApp($booking)
    {
        $message = "Halo {$booking->patient_name},\n\n";
        $message .= "Booking Anda telah dibatalkan.\n\n";
        $message .= "Silakan hubungi admin untuk informasi lebih lanjut.\n";
        $message .= "Terima kasih.";
        
        \Log::info("WhatsApp Cancellation to {$booking->phone}: {$message}");
        
        return true;
    }
}