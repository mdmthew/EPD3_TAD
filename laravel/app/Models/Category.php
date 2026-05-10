<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_group_id',
        'name',
        'slug',
    ];
    
    public function group()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
