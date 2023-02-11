<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CheckoutController extends Controller
{
    public function index()
    {
        $cart = new CartController();
        $city = new CityController();
        $c_address = new AddressController();
        return view('store.checkout.checkout')->with([
            'items' => $cart->get_user_cart_items(),
            'total_price' => $cart->get_total_price(),
            'cities' => $city->cities(),
            'customer_addresses' => $c_address->customer_addresses(),
        ]);
    }

    public function pay(Request $r )
    {
        $orderController = new OrderController();
        $order_code = $this->create_new_order_code();
        OrderController::add_user_cart_items_to_order($order_code, $r->how_to_send, $r->address, $r->payment_status);
        
        $this->increase_last_order_number();
        CartController::delete_user_cart_items();

        
        

        // if($r->payment_status === 'online'){
            $total_price = $orderController->get_order_total_price_by_order_code($order_code);
            $payment_authority = ZarinpalController::get_authority($total_price);
            $orderController->set_payment_authority_for_order_by_order_code($order_code, $payment_authority);
            return ZarinpalController::go_to_pay($payment_authority);
        // }
        return null;
    }

    public function verify_online_pay($amount)
    {
        $result = ZarinpalController::verify($amount);
        if($result){
            $orderController = new OrderController();
            OrderController::set_payment_tracking_number_for_order_by_authority($result['authority'], $result['refID']);
            return view('store.checkout.verify-pay')->with([
                'message' => "پرداخت با موفیت انجام شد. کد رهگیری : " . $result['refID']
            ]);
        }
        return view('store.checkout.verify-pay')->with([
            'error' => "خطا در انجام تراکنش"
        ]);
    }

    public function create_new_order_code()
    {
        $o = new OptionController();
        $last_order_code = $o->get_by_key('last_order_number');
        if(!$last_order_code){
            $last_order_code = $o->add('last_order_number', 0);
        }
        $d = Carbon::now();
        return $d->format('Y'). $d->format('m') . $d->format('d') . $last_order_code->value + 1;

    }

    public function increase_last_order_number()
    {
        $o = new OptionController();
        $loc = $o->get_by_key('last_order_number');
        $o->edit($loc->key, $loc->value+1);
    }
}
