<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use App\Models\ProductProducer;
use Illuminate\Http\Request;

class ProductProducerController extends Controller
{
    public function add($p_id, $name, $seller_name = null)
    {
        if(!$seller_name){
            $seller_name = $name;
        }
        $product_producer = ProductProducer::create([
            'product_id' => $p_id,
            'name' => $name,
            'seller_name' => $seller_name
        ]);
        return $product_producer;
    }

    public function edit(Request $r)
    {
        $producer = ProductProducer::updateOrCreate(
            [
                'product_id' => $r->product_id,
                'name' => $r->name,
                'seller_name' => $r->seller_name,
            ]
        );
        ProductPrice::create([
            'product_id' => $r->product_id,
            'product_producer_id' => $producer->id,
            'price' => $r->price
        ]);
        
        return $producer->product();
    }

    public function get($id)
    {
        $pp = ProductProducer::find($id);
        return $pp;
    }

    public static function get_statically($id)
    {
        $pp = ProductProducer::find($id);
        return $pp;
    }

    public function get_details($id)
    {
        $pp = ProductProducer::find($id);
        $pp->price = $pp->price();
        $pp->features = $pp->features();
        return $pp;
    }

    public function get_user_product_producers_id()
    {
        $products_id = (new ProductController())->get_user_products_id();
        return ProductProducer::whereIn('product_id', $products_id)->get()->pluck('id')->values();
    }

    public function get_producer_products_by_pro_name($name)
    {
        
    }

    public function show_list()
    {
        return view('admin.price.list');
    }

    public function get_prices_data()
    {
        return [
            'data' => ProductProducer::get()->each(function($c){
                $c->product = $c->product();
                $c->price = $c->price();
                $c->producer_seller = $c->name . "-" . $c->seller_name;
            })
        ];
    }
}
