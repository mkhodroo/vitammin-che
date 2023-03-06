<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    public function index()
    {
        return view('store.request.index');
    }

    public function add(Request $r)
    {
        SmsController::new_order_to_admin('درخواست');
        return ModelsRequest::create($r->all());
    }

    public function edit(Request $r)
    {
        return ModelsRequest::find($r->id)->update($r->all());
    }

    public function delete(Request $r)
    {
        ModelsRequest::find($r->id)->delete();
    }

    public function get($id)
    {
        return ModelsRequest::find($id);
    }

    public function get_all()
    {
        return ModelsRequest::get();
    }

}
