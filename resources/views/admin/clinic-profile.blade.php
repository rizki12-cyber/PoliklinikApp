@extends('admin.layouts.admin')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Profil Klinik</h2>
    <p class="text-muted">Kelola informasi profil klinik</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.clinic-profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Klinik</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $clinic->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Logo</label>
                    @if($clinic->logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $clinic->logo) }}" class="img-thumbnail" style="max-height: 80px;">
                        </div>
                    @endif
                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" 
                           accept="image/*">
                    <small class="text-muted">Format: JPG, PNG. Maks: 1MB</small>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="4" required>{{ old('description', $clinic->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Visi</label>
                    <textarea name="vision" class="form-control @error('vision') is-invalid @enderror" 
                              rows="4">{{ old('vision', $clinic->vision) }}</textarea>
                    @error('vision')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Misi</label>
                    <textarea name="mission" class="form-control @error('mission') is-invalid @enderror" 
                              rows="4">{{ old('mission', $clinic->mission) }}</textarea>
                    @error('mission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label class="form-label fw-bold">Alamat</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                              rows="3" required>{{ old('address', $clinic->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-bold">Telepon</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                           value="{{ old('phone', $clinic->phone) }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $clinic->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-bold">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror" 
                           value="{{ old('whatsapp_number', $clinic->whatsapp_number) }}" placeholder="6281234567890">
                    <small class="text-muted">Gunakan format 628xxxx (tanpa + atau 0 di depan)</small>
                    @error('whatsapp_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jam Operasional Mulai</label>
                    <input type="time" name="operational_start" class="form-control @error('operational_start') is-invalid @enderror" 
                           value="{{ old('operational_start', $clinic->operational_start) }}" required>
                    @error('operational_start')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jam Operasional Selesai</label>
                    <input type="time" name="operational_end" class="form-control @error('operational_end') is-invalid @enderror" 
                           value="{{ old('operational_end', $clinic->operational_end) }}" required>
                    @error('operational_end')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label class="form-label fw-bold">Google Maps Embed URL / Link</label>
                    <textarea name="map_embed_url" class="form-control @error('map_embed_url') is-invalid @enderror" 
                              rows="4" placeholder="https://www.google.com/maps/embed?pb=...">{{ old('map_embed_url', $clinic->map_embed_url) }}</textarea>
                    <div class="mt-2 p-3 bg-light rounded-3">
                        <small class="text-muted d-block mb-2">
                            <strong>Cara mendapatkan link Google Maps:</strong>
                        </small>
                        <ol class="small text-muted mb-0">
                            <li>Buka Google Maps di browser</li>
                            <li>Cari lokasi klinik Anda</li>
                            <li>Klik tombol <strong>"Share"</strong> (Bagikan)</li>
                            <li>Pilih tab <strong>"Embed a map"</strong> (Sematan peta)</li>
                            <li>Copy URL dari atribut <strong>src</strong> pada iframe</li>
                            <li>Atau bisa juga copy seluruh kode iframe</li>
                        </ol>
                        <div class="mt-2">
                            <span class="badge bg-primary">Contoh URL:</span>
                            <code class="small d-block mt-1 text-dark">https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966...</code>
                            <span class="badge bg-success mt-2">Atau</span>
                            <code class="small d-block mt-1 text-dark">&lt;iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"&gt;&lt;/iframe&gt;</code>
                        </div>
                    </div>
                    @error('map_embed_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Preview Maps -->
                @if($clinic->map_embed_url)
                <div class="col-12">
                    <label class="form-label fw-bold">Preview Peta</label>
                    <div class="rounded-4 overflow-hidden shadow-sm" style="height: 300px; background: #f8f9fa;">
                        @php
                            $previewMap = $clinic->map_embed_url;
                            if (!empty($previewMap) && !str_contains($previewMap, '<iframe')) {
                                if (str_contains($previewMap, 'google.com/maps/embed')) {
                                    $previewMap = '<iframe src="' . $previewMap . '" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
                                }
                            }
                        @endphp
                        {!! $previewMap !!}
                    </div>
                </div>
                @endif
                
                <div class="col-12">
                    <hr>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection