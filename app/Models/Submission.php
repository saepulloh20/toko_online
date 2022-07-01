<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'products_id', 'race_type', 'distance', 'average_pace', 'time', 'photos', 'status', 'users_id', 'updated_at', 'created_at', 'deleted_at'
    ];

    protected $hidden = [];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'race_type');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
