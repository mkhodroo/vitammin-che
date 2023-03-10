<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductImageController extends Controller
{
    private $product_image_path;
    
    public function __construct() {
        $this->product_image_path = public_path('products/images');
    }

    public function add(Request $r)
    {
        ProductImage::create([
            'product_id' => $r->product_id,
            'image' => base64_encode(file_get_contents($r->file('file')->getRealPath()))
        ]);
        return response('تصویر اضافه شد.');
    }

    public function get_product_images($product_id)
    {
        return ProductImage::where('product_id', $product_id)->get();
    }

    public function remove(Request $r)
    {
        $filename =  $r->get('filename');
        ProductImage::where('filename',$filename)->delete();
        $path=$this->product_image_path . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response('تصویر حذف شد'); 
    }

    public function delete_by_id($id)
    {
        try{
            ProductImage::find($id)->delete();
            return response("تصویر حذف شد.");
        }
        catch(Exception $ex){
            return response($ex->getMessage(),500);
        }
    }
}
