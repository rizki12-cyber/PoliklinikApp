<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'slug', 'summary', 'content', 'image', 'views', 'is_published'];
    
    protected $casts = [
        'is_published' => 'boolean',
        'views' => 'integer',
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

        // Accessor untuk mendapatkan badge status
    public function getStatusBadgeAttribute()
    {
        if ($this->is_published) {
            return '<span class="badge bg-success rounded-pill px-2 py-1">
                        <i class="bi bi-check-circle me-1"></i>Published
                    </span>';
        }
        
        return '<span class="badge bg-warning rounded-pill px-2 py-1">
                    <i class="bi bi-pencil me-1"></i>Draft
                </span>';
    }
}