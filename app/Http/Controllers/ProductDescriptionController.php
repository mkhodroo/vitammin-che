<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductDescription;
use Illuminate\Http\Request;

class ProductDescriptionController extends Controller
{
    public static function edit_dr_description(Request $r)
    {
        ProductDescription::updateOrCreate(
            [
            'product_id' => $r->product_id
            ],
            [
                'name' => 'dr-description',
                'description' => $r->dr_decription
            ]
            );
    }
}
