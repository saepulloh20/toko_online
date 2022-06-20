<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'photo', 'slug', 'deleted_at'
    ];

    protected $hidden = [];

    public function sizechart()
    {
        return $this->hasOne(SizeChart::class, 'categories_id', 'id');
    }
}
