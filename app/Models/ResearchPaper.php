<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchPaper extends Model
{
    protected $fillable = [
        'title', 'authors', 'journal', 'publication_date',
        'volume_issue', 'type', 'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeArticles($query)
    {
        return $query->where('type', 'article');
    }

    public function scopeCaseReports($query)
    {
        return $query->where('type', 'case_report');
    }
}
