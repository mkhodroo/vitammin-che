<?php

namespace App\Models;

use App\Http\Controllers\ProductPriceController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ProductProducer extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'name', 'seller_name'
    ];

    public function price()
    {
        $price = ProductPrice::where('product_producer_id', $this->id)->whereNotNull('price')->latest()->first();
        if($price?->price){
            $price = ProductPriceController::cal_price($price);
        }
        return $price;
    }


    public function old_price()
    {
        $price = ProductPrice::where('product_producer_id', $this->id)->whereNotNull('price')->latest()->skip(1)->first();
        
        return $price;
    }

    public function product()
    {
        return Product::find($this->product_id);
    }

    public function features()
    {
        return ProducerFeature::where('producer_id', $this->id)->get();
    }
}
