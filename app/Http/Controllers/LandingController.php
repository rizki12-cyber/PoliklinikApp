<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Booking;
use App\Models\ClinicProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        try {
            $clinic = ClinicProfile::first();
            $services = Service::where('is_active', true)->take(6)->get();
            $doctors = Doctor::where('is_active', true)->take(4)->get();
            
            // Query artikel dengan search
            $articlesQuery = Article::where('is_published', true);
            
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $articlesQuery->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('summary', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            }
            
            $articles = $articlesQuery->orderBy('created_at', 'desc')->take(3)->get();
            
            // Untuk search result page
            if ($request->has('search') && $request->ajax()) {
                return response()->json($articles);
            }
            
            return view('landing.index', compact('clinic', 'services', 'doctors', 'articles'));
            
        } catch (\Exception $e) {
            Log::error('Landing page error: ' . $e->getMessage());
            return view('landing.index', [
                'clinic' => null,
                'services' => collect([]),
                'doctors' => collect([]),
                'articles' => collect([])
            ]);
        }
    }
    
    /**
     * Menampilkan detail booking dari QR code
     * Ketika user scan QR code, halaman ini akan terbuka
     */
    public function showBookingDetail($code)
    {
        try {
            // Cari booking berdasarkan kode
            $booking = Booking::where('booking_code', $code)
                        ->with('doctor')
                        ->first();
            
            if (!$booking) {
                abort(404, 'Booking tidak ditemukan');
            }
            
            // Ambil data klinik
            $clinic = ClinicProfile::first();
            
            // Kirim data ke view khusus untuk detail booking
            return view('landing.booking-detail', compact('booking', 'clinic'));
            
        } catch (\Exception $e) {
            Log::error('Booking detail error: ' . $e->getMessage());
            abort(404, 'Halaman tidak ditemukan');
        }
    }
    
    public function article($slug)
    {
        try {
            $article = Article::where('slug', $slug)
                ->where('is_published', true)
                ->firstOrFail();
            
            $article->increment('views');
            
            $relatedArticles = Article::where('is_published', true)
                ->where('id', '!=', $article->id)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
            
            $recentArticles = Article::where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            
            $clinic = ClinicProfile::first();
            
            return view('landing.article', compact('article', 'relatedArticles', 'recentArticles', 'clinic'));
            
        } catch (\Exception $e) {
            Log::error('Article detail error: ' . $e->getMessage());
            abort(404, 'Artikel tidak ditemukan');
        }
    }
    
    // API endpoint untuk search artikel
    public function searchArticles(Request $request)
    {
        try {
            $search = $request->get('q', '');
            
            $articles = Article::where('is_published', true)
                ->where(function($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                          ->orWhere('summary', 'like', "%{$search}%")
                          ->orWhere('content', 'like', "%{$search}%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate(6);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'articles' => $articles,
                    'total' => $articles->total()
                ]);
            }
            
            return view('landing.search-results', compact('articles', 'search'));
            
        } catch (\Exception $e) {
            Log::error('Search articles error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari artikel'
            ], 500);
        }
    }
    
    public function getDoctors(Request $request)
    {
        try {
            $doctors = Doctor::where('is_active', true)
                ->when($request->specialization, function($query, $specialization) {
                    return $query->where('specialization', 'like', "%{$specialization}%");
                })
                ->get();
            
            if ($request->ajax()) {
                return response()->json($doctors);
            }
            
            return view('landing.doctors', compact('doctors'));
            
        } catch (\Exception $e) {
            Log::error('Get doctors error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengambil data dokter'], 500);
        }
    }
    
    public function getDoctorSchedule($doctorId, $date)
    {
        try {
            Log::info('Get schedule called', ['doctor_id' => $doctorId, 'date' => $date]);
            
            $doctor = Doctor::find($doctorId);
            
            if (!$doctor || !$doctor->is_active) {
                return response()->json([
                    'available' => false,
                    'message' => 'Dokter tidak ditemukan atau tidak aktif'
                ]);
            }
            
            // Get day name in English (Monday, Tuesday, etc.)
            $dayOfWeek = date('l', strtotime($date)); // Returns 'Monday', 'Tuesday', etc.
            
            Log::info('Checking schedule', [
                'doctor' => $doctor->name,
                'day' => $dayOfWeek,
                'date' => $date
            ]);
            
            // Cari schedule dengan day dalam bahasa Inggris
            $schedule = $doctor->schedules()
                ->where('day', $dayOfWeek)
                ->where('is_active', true)
                ->first();
            
            if (!$schedule) {
                // Coba cari dengan case insensitive
                $schedule = $doctor->schedules()
                    ->whereRaw('LOWER(day) = ?', [strtolower($dayOfWeek)])
                    ->where('is_active', true)
                    ->first();
            }
            
            if (!$schedule) {
                $dayIndonesian = $this->getDayNameIndonesian($dayOfWeek);
                return response()->json([
                    'available' => false,
                    'message' => "Dokter tidak praktik pada hari {$dayIndonesian}"
                ]);
            }
            
            // Hitung booking yang sudah ada
            $bookedCount = Booking::where('doctor_id', $doctorId)
                ->whereDate('booking_date', $date)
                ->where('status', '!=', 'cancelled')
                ->count();
            
            $maxPerDay = $doctor->max_booking_per_day ?? 20;
            $remainingSlots = $maxPerDay - $bookedCount;
            
            if ($remainingSlots <= 0) {
                return response()->json([
                    'available' => false,
                    'message' => "Kuota booking untuk tanggal ini sudah penuh (Maksimal {$maxPerDay} pasien)"
                ]);
            }
            
            // Generate available time slots (30 menit interval)
            $availableSlots = $this->generateTimeSlots($schedule->start_time, $schedule->end_time, $doctorId, $date);
            
            if (empty($availableSlots)) {
                return response()->json([
                    'available' => false,
                    'message' => "Tidak ada jam tersedia untuk hari ini (semua jam sudah terbooking)"
                ]);
            }
            
            return response()->json([
                'available' => true,
                'message' => "✅ Jadwal tersedia! Sisa kuota: {$remainingSlots} pasien",
                'remaining_slots' => $remainingSlots,
                'schedule' => [
                    'start_time' => $schedule->start_time,
                    'end_time' => $schedule->end_time
                ],
                'available_slots' => $availableSlots
            ]);
            
        } catch (\Exception $e) {
            Log::error('Get schedule error: ' . $e->getMessage());
            return response()->json([
                'available' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
    
    public function booking(Request $request)
    {
        try {
            $validated = $request->validate([
                'patient_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'doctor_id' => 'required|exists:doctors,id',
                'booking_date' => 'required|date|after_or_equal:today',
                'booking_time' => 'required|string',
                'complaint' => 'required|string|min:10'
            ]);
            
            $doctor = Doctor::findOrFail($request->doctor_id);
            
            // Cek apakah dokter aktif
            if (!$doctor->is_active) {
                return back()->withInput()->with('error', 'Maaf, dokter sedang tidak aktif. Silakan pilih dokter lain.');
            }
            
            $bookingDate = $request->booking_date;
            $bookingTime = $request->booking_time;
            
            // Get day name in English
            $dayOfWeek = date('l', strtotime($bookingDate));
            
            // Cek jadwal dokter
            $schedule = $doctor->schedules()
                ->where('day', $dayOfWeek)
                ->where('is_active', true)
                ->first();
            
            if (!$schedule) {
                return back()->withInput()->with('error', "Dokter tidak praktik pada tanggal tersebut");
            }
            
            // Cek apakah waktu booking dalam range jadwal
            $startTime = date('H:i', strtotime($schedule->start_time));
            $endTime = date('H:i', strtotime($schedule->end_time));
            
            if ($bookingTime < $startTime || $bookingTime >= $endTime) {
                return back()->withInput()->with('error', "Jam booking ({$bookingTime}) di luar jam praktik dokter ({$startTime} - {$endTime})");
            }
            
            // Cek kuota booking
            $bookedCount = Booking::where('doctor_id', $request->doctor_id)
                ->whereDate('booking_date', $bookingDate)
                ->where('status', '!=', 'cancelled')
                ->count();
            
            $maxPerDay = $doctor->max_booking_per_day ?? 20;
            
            if ($bookedCount >= $maxPerDay) {
                return back()->withInput()->with('error', "Maaf, kuota untuk tanggal tersebut sudah penuh (Maksimal {$maxPerDay} pasien)");
            }
            
            // Cek apakah jam sudah dibooking
            $existingBooking = Booking::where('doctor_id', $request->doctor_id)
                ->whereDate('booking_date', $bookingDate)
                ->where('booking_time', $bookingTime)
                ->where('status', '!=', 'cancelled')
                ->exists();
            
            if ($existingBooking) {
                return back()->withInput()->with('error', "Jam {$bookingTime} sudah dibooking. Silakan pilih jam lain.");
            }
            
            // Generate unique booking code
            $bookingCode = 'MED' . date('Ymd') . strtoupper(substr(uniqid(), -6));
            
            // Cek unique code
            while (Booking::where('booking_code', $bookingCode)->exists()) {
                $bookingCode = 'MED' . date('Ymd') . strtoupper(substr(uniqid(), -6));
            }
            
            $booking = Booking::create([
                'booking_code' => $bookingCode,
                'patient_name' => $request->patient_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'doctor_id' => $request->doctor_id,
                'booking_date' => $bookingDate,
                'booking_time' => $bookingTime,
                'complaint' => $request->complaint,
                'status' => 'confirmed',
            ]);
            
            // Buat URL untuk QR code (arah ke halaman detail booking)
            $bookingDetailUrl = route('booking.detail', $bookingCode);
            
            // Flash data untuk SweetAlert dengan tambahan URL
            session()->flash('booking_success', true);
            session()->flash('booking_data', [
                'code' => $bookingCode,
                'patient_name' => $booking->patient_name,
                'doctor_name' => $doctor->name,
                'doctor_id' => $doctor->id,
                'date' => date('d/m/Y', strtotime($booking->booking_date)),
                'time' => $booking->booking_time,
                'phone' => $booking->phone,
                'complaint' => $booking->complaint,
                'qr_url' => $bookingDetailUrl
            ]);
            
            return redirect()->route('landing');
            
        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal melakukan booking: ' . $e->getMessage());
        }
    }
    
    // Helper function to generate time slots
    private function generateTimeSlots($startTime, $endTime, $doctorId, $date, $interval = 30)
    {
        $slots = [];
        $start = new \DateTime($startTime);
        $end = new \DateTime($endTime);
        
        // Get already booked slots
        $bookedSlots = Booking::where('doctor_id', $doctorId)
            ->whereDate('booking_date', $date)
            ->where('status', '!=', 'cancelled')
            ->pluck('booking_time')
            ->toArray();
        
        while ($start < $end) {
            $timeSlot = $start->format('H:i');
            
            // Only add if not booked
            if (!in_array($timeSlot, $bookedSlots)) {
                $slots[] = $timeSlot;
            }
            
            $start->modify("+{$interval} minutes");
        }
        
        return $slots;
    }
    
    // Helper function to get Indonesian day name
    private function getDayNameIndonesian($englishDay)
    {
        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        
        return $days[$englishDay] ?? $englishDay;
    }

    public function cancelBooking($code)
    {
        try {
            $booking = Booking::where('booking_code', $code)->first();
            
            if (!$booking) {
                return response()->json(['success' => false, 'message' => 'Booking tidak ditemukan']);
            }
            
            if ($booking->status == 'cancelled') {
                return response()->json(['success' => false, 'message' => 'Booking sudah dibatalkan']);
            }
            
            $booking->update(['status' => 'cancelled']);
            
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Tambahkan method ini di LandingController.php

/**
 * Mendapatkan tanggal-tanggal yang tersedia untuk dokter tertentu
 */
public function getAvailableDates($doctorId)
{
    try {
        $doctor = Doctor::findOrFail($doctorId);
        
        // Ambil semua jadwal dokter
        $schedules = $doctor->schedules()
            ->where('is_active', true)
            ->get();
        
        // Ambil hari-hari dimana dokter praktik (dalam bahasa Inggris)
        $availableDays = $schedules->pluck('day')->map(function($day) {
            return $day; // Monday, Tuesday, etc.
        })->toArray();
        
        // Generate tanggal-tanggal yang tersedia (30 hari ke depan)
        $availableDates = [];
        $startDate = now();
        $endDate = now()->addDays(30);
        
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $dayName = $date->format('l'); // Monday, Tuesday, etc.
            
            // Cek apakah hari ini termasuk jadwal dokter
            if (in_array($dayName, $availableDays)) {
                // Cek kuota
                $bookedCount = Booking::where('doctor_id', $doctorId)
                    ->whereDate('booking_date', $date->format('Y-m-d'))
                    ->where('status', '!=', 'cancelled')
                    ->count();
                
                $maxPerDay = $doctor->max_booking_per_day ?? 20;
                $remainingSlots = $maxPerDay - $bookedCount;
                
                if ($remainingSlots > 0) {
                    $availableDates[] = [
                        'date' => $date->format('Y-m-d'),
                        'day' => $this->getDayNameIndonesian($dayName),
                        'remaining_slots' => $remainingSlots
                    ];
                }
            }
        }
        
        return response()->json([
            'success' => true,
            'dates' => $availableDates
        ]);
        
    } catch (\Exception $e) {
        Log::error('Get available dates error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil tanggal tersedia'
        ]);
    }
}
}