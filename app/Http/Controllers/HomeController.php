<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\ProductCatagory;
use App\Models\ProductProducer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products = new ProductController();
        $posts = new BlogPostController();
        return view('store.home.home')->with([
            'newest_products' =>  ProductProducerController::newests(),
            'catagories' => ProductCatagory::get(),
            'newest_posts' => $posts->newest_posts(),
        ]);
    }

    public function contact_us()
    {
        return view('store.home.contact-us');
    }
}
