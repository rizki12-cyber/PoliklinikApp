<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicProfile extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'description', 'vision', 'mission', 'address', 
        'phone', 'email', 'logo', 'map_embed_url', 'whatsapp_number',
        'operational_start', 'operational_end'
    ];

       public function getLogoUrlAttribute()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            return asset('storage/' . $this->logo);
        }
        return asset('images/default-logo.png');
    }
}