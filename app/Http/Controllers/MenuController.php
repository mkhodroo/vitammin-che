<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function get($item)
    {
        $view = "store.menu.$item";
        return view($view);
    }
}
