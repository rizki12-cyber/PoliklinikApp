<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalDoctors = Doctor::count();
        $totalServices = Service::count();
        $totalBookings = Booking::count();
        $totalArticles = Article::count();
        
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        $completedBookings = Booking::where('status', 'completed')->count();
        
        // Data untuk chart status
        $statusData = [
            'pending' => $pendingBookings,
            'confirmed' => $confirmedBookings,
            'completed' => $completedBookings,
            'cancelled' => $cancelledBookings,
        ];
        
        // Recent bookings
        $recentBookings = Booking::with('doctor')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // ========== DATA UNTUK GRAFIK HARIAN (7 Hari Terakhir) ==========
        $dailyLabels = [];
        $dailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dailyLabels[] = $date->format('D'); // Sen, Sel, Rab, Kam, Jum, Sab, Min
            $dailyData[] = Booking::whereDate('booking_date', $date->format('Y-m-d'))->count();
        }
        
        // ========== DATA UNTUK GRAFIK MINGGUAN (4 Minggu Terakhir) ==========
        $weeklyLabels = [];
        $weeklyData = [];
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            $weeklyLabels[] = 'Minggu ' . (4 - $i);
            $weeklyData[] = Booking::whereBetween('booking_date', [$startOfWeek, $endOfWeek])->count();
        }
        
        // ========== DATA UNTUK GRAFIK BULANAN (12 Bulan Terakhir) ==========
        $monthlyLabels = [];
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $date->format('M'); // Jan, Feb, Mar, Apr, Mei, Jun, Jul, Ags, Sep, Okt, Nov, Des
            $monthlyData[] = Booking::whereMonth('booking_date', $date->month)
                ->whereYear('booking_date', $date->year)
                ->count();
        }
        
        return view('admin.dashboard', compact(
            'totalDoctors',
            'totalServices', 
            'totalBookings',
            'totalArticles',
            'pendingBookings',
            'statusData',
            'recentBookings',
            'dailyLabels',
            'dailyData',
            'weeklyLabels',
            'weeklyData',
            'monthlyLabels',
            'monthlyData'
        ));
    }
}