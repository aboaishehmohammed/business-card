<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    protected $fillable=['extension','upload_path','mime'];

    use SoftDeletes;
    public function category()
    {
        return $this->belongsToMany(Category::class, "category_images");
    }
}
