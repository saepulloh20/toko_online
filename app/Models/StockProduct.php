<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'products_id', 'categories_id', 'stock', 'id', 'updated_at', 'created_at', 'deleted_at'
    ];

    protected $hiden = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(SizeChart::class, 'sizecharts_id', 'id');
    }

    // public function products()
    // {
    //     return $this->belongsTo(Product::class, 'id', 'products_id');
    // }
}
