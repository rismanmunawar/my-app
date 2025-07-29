<?php

namespace App\Models\Docs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'docs_categories';
    protected $fillable = ['name'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
