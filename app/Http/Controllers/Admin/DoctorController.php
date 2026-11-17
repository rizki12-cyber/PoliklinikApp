<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('schedules')->orderBy('created_at', 'desc')->get();
        return view('admin.doctors.index', compact('doctors'));
    }
    
    public function create()
    {
        return view('admin.doctors.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'max_booking_per_day' => 'required|integer|min:1|max:50',
        ]);
        
        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }
        
        $doctor = Doctor::create($data);
        
        // Create schedules
        if ($request->has('schedules')) {
            foreach ($request->schedules as $schedule) {
                if (!empty($schedule['day']) && !empty($schedule['start_time'])) {
                    Schedule::create([
                        'doctor_id' => $doctor->id,
                        'day' => $schedule['day'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time'] ?? '17:00:00',
                        'is_active' => true,
                    ]);
                }
            }
        }
        
        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil ditambahkan');
    }
    
    public function edit(Doctor $doctor)
    {
        $doctor->load('schedules');
        return view('admin.doctors.edit', compact('doctor'));
    }
    
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'max_booking_per_day' => 'required|integer|min:1|max:50',
        ]);
        
        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }
        
        $doctor->update($data);
        
        // Update schedules
        if ($request->has('schedules')) {
            Schedule::where('doctor_id', $doctor->id)->delete();
            foreach ($request->schedules as $schedule) {
                if (!empty($schedule['day']) && !empty($schedule['start_time'])) {
                    Schedule::create([
                        'doctor_id' => $doctor->id,
                        'day' => $schedule['day'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time'] ?? '17:00:00',
                        'is_active' => true,
                    ]);
                }
            }
        }
        
        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil diupdate');
    }
    
    public function destroy(Doctor $doctor)
    {
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }
        $doctor->delete();
        
        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil dihapus');
    }
    
    public function toggleStatus(Doctor $doctor)
{
    $doctor->is_active = !$doctor->is_active;
    $doctor->save();
    
    return response()->json(['success' => true]);
}

    public function show(Doctor $doctor)
    {
        $doctor->load('schedules');
        
        return view('admin.doctors.show', compact('doctor'));
    }
}