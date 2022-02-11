<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
        'id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
