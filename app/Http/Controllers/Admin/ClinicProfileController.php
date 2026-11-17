<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClinicProfileController extends Controller
{
    public function edit()
    {
        $clinic = ClinicProfile::first();
        if (!$clinic) {
            $clinic = ClinicProfile::create([
                'name' => 'Klinik Kesehatan',
                'description' => 'Klinik kesehatan terpercaya',
                'address' => 'Jakarta',
                'phone' => '021-1234567',
            ]);
        }
        return view('admin.clinic-profile', compact('clinic'));
    }
    
    public function update(Request $request)
    {
        $clinic = ClinicProfile::first();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'map_embed_url' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:20',
            'operational_start' => 'required',
            'operational_end' => 'required',
        ]);
        
        $data = $request->except('logo');
        
        if ($request->hasFile('logo')) {
            if ($clinic && $clinic->logo) {
                Storage::disk('public')->delete($clinic->logo);
            }
            $data['logo'] = $request->file('logo')->store('clinic', 'public');
        }
        
        if ($clinic) {
            $clinic->update($data);
        } else {
            ClinicProfile::create($data);
        }
        
        return redirect()->back()->with('success', 'Profil klinik berhasil diperbarui');
    }
}