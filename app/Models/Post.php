<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'description',
        'is_published',
        'category_id',
        'gallery_id',
    ];

    //because of foreign key stored in Post table Must use Belongs to
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
