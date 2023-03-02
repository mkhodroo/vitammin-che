<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasFactory;
    public $table = 'product_description';
    protected $fillable = [
        'name', 'description', 'product_id'
    ];
}
