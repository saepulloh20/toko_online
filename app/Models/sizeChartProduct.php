<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sizeChartProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'products_id', 'sizecharts_id', 'stock', 'id'
    ];

    protected $hiden = [];

    public function sizeChart()
    {
        return $this->hasOne(sizeChart::class, 'sizecharts_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
