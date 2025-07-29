<?php

namespace App\Models\Docs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Docs\Category as DocsCategory;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'docs_subcategories';

    protected $fillable = ['category_id', 'name'];


    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
    public function category()
    {
        return $this->belongsTo(DocsCategory::class, 'category_id');
    }
}
