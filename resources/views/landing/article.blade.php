{{-- resources/views/landing/article.blade.php --}}
@extends('layouts.landing')

@section('title', $article->title . ' - Klinik Sehat')

@section('content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-4 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('landing') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#articles" class="text-decoration-none">Artikel</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Article Detail -->
<section class="article-detail-section py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="article-detail-card bg-white rounded-4 shadow-sm overflow-hidden">
                    @if($article->image)
                    <div class="article-header-image">
                        <img src="{{ asset('storage/' . $article->image) }}" 
                             alt="{{ $article->title }}" 
                             class="w-100" 
                             style="height: 400px; object-fit: cover;">
                    </div>
                    @endif
                    
                    <div class="p-4 p-lg-5">
                        <!-- Article Meta -->
                        <div class="article-meta mb-4">
                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill">
                                    <i class="bi bi-newspaper me-1"></i> Artikel Kesehatan
                                </span>
                                <span class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $article->created_at->format('d F Y') }}
                                </span>
                                <span class="text-muted">
                                    <i class="bi bi-eye me-1"></i> {{ number_format($article->views) }} views
                                </span>
                                <span class="text-muted">
                                    <i class="bi bi-clock me-1"></i> {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read
                                </span>
                            </div>
                        </div>
                        
                        <!-- Article Title -->
                        <h1 class="display-5 fw-bold mb-4">{{ $article->title }}</h1>
                        
                        <!-- Article Summary -->
                        @if($article->summary)
                        <div class="article-summary bg-light p-4 rounded-4 mb-4 border-start border-4 border-primary">
                            <i class="bi bi-quote fs-1 text-primary opacity-50"></i>
                            <p class="lead mb-0">{{ $article->summary }}</p>
                        </div>
                        @endif
                        
                        <!-- Article Content -->
                        <div class="article-content">
                            {!! $article->content !!}
                        </div>
                        
                        <!-- Share Section -->
                        <div class="article-share mt-5 pt-4 border-top">
                            <h6 class="fw-bold mb-3"><i class="bi bi-share-fill me-2"></i>Bagikan Artikel Ini</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                   target="_blank" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" 
                                   target="_blank" class="btn btn-outline-info rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
                                   target="_blank" class="btn btn-outline-success rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="mailto:?subject={{ urlencode($article->title) }}&body={{ urlencode(url()->current()) }}" 
                                   class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Author Info (opsional) -->
                        <div class="article-author mt-5 p-4 bg-light rounded-4 d-flex align-items-center gap-3">
                            <div class="author-avatar">
                                <i class="bi bi-person-circle fs-1 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Tim Redaksi Klinik Sehat</h6>
                                <p class="text-muted small mb-0">Artikel ini ditulis oleh tim medis profesional kami dan telah diverifikasi kebenarannya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Search Box -->
                <div class="sidebar-card bg-white rounded-4 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-search me-2"></i>Cari Artikel</h5>
                    <div class="input-group">
                        <input type="text" id="searchArticle" class="form-control" placeholder="Cari artikel...">
                        <button class="btn btn-primary" onclick="searchArticle()">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Recent Articles -->
                <div class="sidebar-card bg-white rounded-4 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>Artikel Terbaru</h5>
                    <div class="recent-articles">
                        @forelse($recentArticles as $recent)
                        <a href="{{ route('article.show', $recent->slug) }}" class="text-decoration-none">
                            <div class="recent-article-item d-flex gap-3 mb-3 pb-3 border-bottom">
                                @if($recent->image)
                                <img src="{{ asset('storage/' . $recent->image) }}" 
                                     alt="{{ $recent->title }}" 
                                     class="rounded-3" 
                                     style="width: 70px; height: 70px; object-fit: cover;">
                                @else
                                <div class="bg-primary-soft rounded-3 d-flex align-items-center justify-content-center" 
                                     style="width: 70px; height: 70px;">
                                    <i class="bi bi-file-text fs-2 text-primary"></i>
                                </div>
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold text-dark">{{ Str::limit($recent->title, 50) }}</h6>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i> {{ $recent->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        </a>
                        @empty
                        <p class="text-muted">Belum ada artikel</p>
                        @endforelse
                    </div>
                </div>
                
                <!-- Categories -->
                <div class="sidebar-card bg-white rounded-4 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-tags me-2"></i>Kategori</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#" class="badge bg-light text-dark text-decoration-none px-3 py-2 rounded-pill">
                            Kesehatan Umum
                        </a>
                        <a href="#" class="badge bg-light text-dark text-decoration-none px-3 py-2 rounded-pill">
                            Gaya Hidup Sehat
                        </a>
                        <a href="#" class="badge bg-light text-dark text-decoration-none px-3 py-2 rounded-pill">
                            Nutrisi
                        </a>
                        <a href="#" class="badge bg-light text-dark text-decoration-none px-3 py-2 rounded-pill">
                            Penyakit
                        </a>
                        <a href="#" class="badge bg-light text-dark text-decoration-none px-3 py-2 rounded-pill">
                            Tips Kesehatan
                        </a>
                    </div>
                </div>
                
                <!-- Related Articles -->
                @if($relatedArticles->count() > 0)
                <div class="sidebar-card bg-white rounded-4 shadow-sm p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-star-fill me-2 text-warning"></i>Artikel Terkait</h5>
                    <div class="related-articles">
                        @foreach($relatedArticles as $related)
                        <a href="{{ route('article.show', $related->slug) }}" class="text-decoration-none">
                            <div class="related-article-item d-flex gap-3 mb-3 pb-3 border-bottom">
                                @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" 
                                     alt="{{ $related->title }}" 
                                     class="rounded-3" 
                                     style="width: 60px; height: 60px; object-fit: cover;">
                                @endif
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-semibold text-dark small">{{ Str::limit($related->title, 60) }}</p>
                                    <small class="text-muted">
                                        <i class="bi bi-eye me-1"></i> {{ number_format($related->views) }} views
                                    </small>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Call to Action -->
                <div class="sidebar-card bg-gradient-primary rounded-4 p-4 text-white text-center mt-4">
                    <i class="bi bi-calendar-check fs-1 mb-3"></i>
                    <h5 class="fw-bold mb-3">Butuh Konsultasi?</h5>
                    <p class="mb-3">Jadwalkan appointment dengan dokter spesialis kami</p>
                    <a href="{{ route('landing') }}#booking" class="btn btn-light rounded-pill px-4">
                        Booking Sekarang <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Article Detail Styles */
.article-detail-card {
    transition: transform 0.3s ease;
}

.article-header-image {
    overflow: hidden;
    position: relative;
}

.article-header-image img {
    transition: transform 0.5s ease;
}

.article-detail-card:hover .article-header-image img {
    transform: scale(1.05);
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #334155;
}

.article-content h1 {
    font-size: 2rem;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.article-content h2 {
    font-size: 1.75rem;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.article-content h3 {
    font-size: 1.5rem;
    margin-top: 1.25rem;
    margin-bottom: 0.75rem;
    font-weight: 600;
}

.article-content p {
    margin-bottom: 1.25rem;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 1.5rem 0;
}

.article-content ul, 
.article-content ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}

.article-content blockquote {
    border-left: 4px solid #0ea5e9;
    padding: 1rem 1.5rem;
    margin: 1.5rem 0;
    background: #f8fafc;
    border-radius: 12px;
    font-style: italic;
}

.article-content table {
    width: 100%;
    margin: 1.5rem 0;
    border-collapse: collapse;
}

.article-content table th,
.article-content table td {
    border: 1px solid #e2e8f0;
    padding: 0.75rem;
}

.article-content table th {
    background: #f8fafc;
    font-weight: 600;
}

/* Sidebar Styles */
.sidebar-card {
    transition: all 0.3s ease;
}

.sidebar-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.recent-article-item,
.related-article-item {
    transition: all 0.3s ease;
}

.recent-article-item:hover,
.related-article-item:hover {
    transform: translateX(5px);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
}

.bg-primary-soft {
    background: rgba(14, 165, 233, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .article-content {
        font-size: 1rem;
    }
    
    .article-content h1 {
        font-size: 1.5rem;
    }
    
    .article-content h2 {
        font-size: 1.25rem;
    }
    
    .article-content h3 {
        font-size: 1.125rem;
    }
}

/* Animation */
.article-detail-card {
    animation: fadeInUp 0.6s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
function searchArticle() {
    const keyword = document.getElementById('searchArticle').value;
    if (keyword) {
        // Implement search functionality
        window.location.href = "{{ route('landing') }}?search=" + encodeURIComponent(keyword);
    }
}

// Add table responsive wrapper
document.addEventListener('DOMContentLoaded', function() {
    const tables = document.querySelectorAll('.article-content table');
    tables.forEach(table => {
        const wrapper = document.createElement('div');
        wrapper.className = 'table-responsive';
        table.parentNode.insertBefore(wrapper, table);
        wrapper.appendChild(table);
    });
});
</script>
@endsection