<?php

namespace App\Http\Controllers;

use App\Enums\enums;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public static function get_product_orders_number($product_id)
    {
        return Order::where('product_producer_id', $product_id)->sum('number');
    }

    public function my_orders()
    {
        if(!Auth::id()){
            return abort('ابتدا وارد شوید', 403);
        }
        return view('store.my-orders.list')->with([
            'order_codes' => $this->get_orders_groupBy_order_code(),
            'orders' => $this->get_orders_by_user_id()
        ]);
    }

    public function get_orders_groupBy_order_code()
    {
        return Order::where('user_id', Auth::id())->select('order_code')->groupBy('order_code')->get();
    }

    public function get_orders_by_user_id()
    {
        return Order::where('user_id', Auth::id())->get();
    }



    public function orders()
    {
        $user_product_producers_id = (new ProductProducerController())->get_user_product_producers_id();
        return view('admin.orders.list')->with([
            'orders_code' => $this->get_orders_code($user_product_producers_id),
            'stores' => (new StoreController())->get_user_stores(),
        ]);
    }

    public function get_orders_code($user_product_producers_id)
    {
        return Order::whereIn('product_producer_id', $user_product_producers_id)
            ->groupBy('order_code')
            ->get()->each(function($c){
                $c->how_to_send = enums::how_to_send[$c->how_to_send];
                $c->payment_status = enums::payment_status[$c->payment_status];
            });
    }

    public function get_order_info_by_order_code($order_code)
    {
        $order = Order::where('order_code', $order_code)->get()->each(function($c){
            $c->product_name = $c->producer()->product()->name;
            $c->producer_name = $c->producer()->name;
            $c->store = $c->store();
        });
        return view('admin.orders.edit')->with([
            'order_code' => $order_code,
            'orders' => $order
        ]);
    }

    public function save_order_store(Request $r)
    {
        $o = Order::find($r->order_id);
        $o->store_id = $r->store_id;
        $o->save();
        $product_inventory = new ProductInventoryController();
        $des = "for order id: $o->id";
        $product_inventory->insert_order_record($o->product_producer_id, $o->store_id, $des, -$o->number);
        return $o;
    }

    public static function get_orders_by_authority($authority){
        return Order::where('authority', $authority)->get();
    }

    public static function set_payment_tracking_number_for_order_by_authority($authority, $refID){
        $orders = self::get_orders_by_authority($authority);
        foreach($orders as $order){
            $order->payment_tracking_number = $refID;
            $order->save();
        }
    }

    public static function add_user_cart_items_to_order($order_code, $how_to_send, $address_id, $payment_status){
        $cart_items = (new CartController())->get_user_cart_items();
        foreach($cart_items as $item){
            Order::create([
                'order_code' => $order_code,
                'product_producer_id' => $item->producer()->id,
                'price' => $item->producer()->price()->price,
                'number' => $item->number,
                'user_id' => Auth::id(),
                'how_to_send' => $how_to_send,
                'customer_address_id' => $address_id,
                'payment_status' => $payment_status
            ]);
        }
    }

    public function get_order_total_price_by_order_code($order_code){
        return Order::where('order_code', $order_code)->sum('price');
    }

    public function set_payment_authority_for_order_by_order_code($order_code, $authority)
    {
        Order::where('order_code', $order_code)->update([ 'authority' => $authority ]);
    }

    public function set_payment_tracking_number_for_order_by_order_code($order_code, $refID)
    {
        Order::where('order_code', $order_code)->update([ 'payment_tracking_number' => $refID ]);
    }
}
