<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\ProductCatagory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products = new ProductController();
        $posts = new BlogPostController();
        return view('store.home.home')->with([
            'newest_products' =>  $products->newest_products(),
            'catagories' => ProductCatagory::get(),
            'newest_posts' => $posts->newest_posts(),
        ]);
    }

    public function contact_us()
    {
        return view('store.home.contact-us');
    }
}
