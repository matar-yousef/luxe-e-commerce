<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, HasSlug, Searchable;

    protected $fillable = ['name', 'slug', 'description'];
    protected $searchable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
