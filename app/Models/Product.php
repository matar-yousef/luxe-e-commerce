<?php

namespace App\Models;

use App\Traits\HasImage;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HandlesImages;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Searchable;

class Product extends Model
{

    use SoftDeletes, HasImage, HandlesImages, Searchable;
    protected $fillable = ['name', 'price', 'stock', 'description', 'category_id'];

    protected $searchable = ['name', 'description'];

    public $imageFolder = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
