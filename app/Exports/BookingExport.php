<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;
    
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function collection()
    {
        return Booking::with('doctor')
            ->whereBetween('booking_date', [$this->startDate, $this->endDate])
            ->get();
    }
    
    public function headings(): array
    {
        return [
            'No',
            'Nama Pasien',
            'Nomor HP',
            'Email',
            'Dokter',
            'Tanggal Booking',
            'Keluhan',
            'Status',
            'Tanggal Booking Dibuat'
        ];
    }
    
    public function map($booking): array
    {
        static $rowNumber = 0;
        $rowNumber++;
        
        return [
            $rowNumber,
            $booking->patient_name,
            $booking->phone,
            $booking->email ?? '-',
            $booking->doctor->name,
            Carbon::parse($booking->booking_date)->format('d/m/Y'),
            $booking->complaint,
            $booking->status,
            $booking->created_at->format('d/m/Y H:i')
        ];
    }
}