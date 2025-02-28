<?php

namespace App;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded=[];

    protected $casts = [
        'position' => 'integer', // Assuming 'position' is an integer
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
