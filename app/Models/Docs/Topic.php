<?php

namespace App\Models\Docs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    protected $table = 'docs_topics';

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'title',
        'content',
        'video_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
