<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ClinicProfile;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        // Create Clinic Profile
        ClinicProfile::create([
            'name' => 'Klinik Sehat Bahagia',
            'description' => 'Klinik kesehatan terpercaya yang memberikan pelayanan medis terbaik untuk keluarga Anda dengan tenaga profesional dan fasilitas modern.',
            'vision' => 'Menjadi klinik kesehatan terdepan di Indonesia yang memberikan pelayanan prima dan solusi kesehatan terbaik.',
            'mission' => '1. Memberikan pelayanan kesehatan yang berkualitas\n2. Mengutamakan kenyamanan dan keselamatan pasien\n3. Mengembangkan teknologi medis terbaru\n4. Menjangkau masyarakat luas dengan layanan terjangkau',
            'address' => 'Jl. Kesehatan No. 123, Kelurahan Sehat, Kecamatan Bahagia, Jakarta Selatan 12345',
            'phone' => '(021) 1234-5678',
            'email' => 'info@kliniksehatbahagia.com',
            'whatsapp_number' => '6281234567890',
            'operational_start' => '08:00',
            'operational_end' => '20:00',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.819561!3d-6.208763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta!5e0!3m2!1sen!2sid!4v1699999999999!5m2!1sen!2sid',
        ]);
        
        // Create Services
        $services = [
            ['name' => 'Pemeriksaan Umum', 'description' => 'Pemeriksaan kesehatan umum lengkap dengan tensi darah, suhu tubuh, dan konsultasi dengan dokter umum.', 'icon' => 'bi-heart-pulse'],
            ['name' => 'Pemeriksaan Gigi', 'description' => 'Perawatan gigi lengkap termasuk scaling, tambal gigi, dan konsultasi kesehatan gigi.', 'icon' => 'bi-eyedropper'],
            ['name' => 'Laboratorium', 'description' => 'Layanan pemeriksaan laboratorium darah, urine, dan pemeriksaan penunjang lainnya.', 'icon' => 'bi-motherboard'],
            ['name' => 'Konsultasi Gizi', 'description' => 'Konsultasi dengan ahli gizi untuk program diet dan pola makan sehat.', 'icon' => 'bi-apple'],
            ['name' => 'KIA (Kesehatan Ibu & Anak)', 'description' => 'Layanan kesehatan untuk ibu hamil, menyusui, dan balita.', 'icon' => 'bi-gender-female'],
            ['name' => 'Farmasi', 'description' => 'Apotek dengan obat-obatan lengkap dan resep dokter.', 'icon' => 'bi-capsule'],
        ];
        
        foreach ($services as $service) {
            Service::create($service);
        }
        
        // Create Doctors
        $doctors = [
            [
                'name' => 'dr. Andi Wijaya, Sp.PD',
                'specialization' => 'Spesialis Penyakit Dalam',
                'description' => 'Dokter spesialis penyakit dalam dengan pengalaman lebih dari 10 tahun.',
                'max_booking_per_day' => 10,
            ],
            [
                'name' => 'dr. Siti Nurhaliza, Sp.GK',
                'specialization' => 'Spesialis Gizi Klinik',
                'description' => 'Ahli gizi yang membantu program diet dan pola makan sehat.',
                'max_booking_per_day' => 8,
            ],
            [
                'name' => 'dr. Budi Santoso, Sp.OG',
                'specialization' => 'Spesialis Obstetri & Ginekologi',
                'description' => 'Dokter spesialis kandungan dengan pelayanan ramah dan profesional.',
                'max_booking_per_day' => 8,
            ],
            [
                'name' => 'dr. Rina Marlina, Sp.A',
                'specialization' => 'Spesialis Anak',
                'description' => 'Dokter spesialis anak yang sabar dan berpengalaman.',
                'max_booking_per_day' => 12,
            ],
        ];
        
        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
        
        // Create Schedules
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        foreach (Doctor::all() as $doctor) {
            foreach ($days as $day) {
                Schedule::create([
                    'doctor_id' => $doctor->id,
                    'day' => $day,
                    'start_time' => '09:00:00',
                    'end_time' => '16:00:00',
                    'is_active' => true,
                ]);
            }
        }
        
        // Create Sample Article
        Article::create([
            'title' => 'Cara Menjaga Kesehatan di Musim Hujan',
            'slug' => 'cara-menjaga-kesehatan-di-musim-hujan',
            'summary' => 'Musim hujan membawa berbagai penyakit. Simak tips menjaga kesehatan Anda dan keluarga.',
            'content' => '<p>Musim hujan seringkali membawa berbagai penyakit seperti flu, demam berdarah, dan infeksi saluran pernapasan. Berikut tips menjaga kesehatan:</p><ul><li>Konsumsi vitamin C secara teratur</li><li>Jaga kebersihan lingkungan</li><li>Gunakan pakaian yang hangat</li><li>Istirahat yang cukup</li></ul>',
            'is_published' => true,
        ]);
    }
}