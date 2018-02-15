<?php

namespace App\Http\Controllers;

use App\DeliveryLocation;
use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Get cart items
     *
     * @return \Illuminate\Http\Response
     */
    public function items()
    {
        $items = [];
        foreach(Cart::content() as $item){
            $cart_item = new \stdClass();
//            $cart_item->product = $item->model;
            $cart_item->name = $item->model->name;
            $cart_item->image = $item->model->image();

            $cart_item->price = $item->model->present_price();
            $cart_item->qty = $item->qty;
            $cart_item->id = $item->rowId;

            $items[] = $cart_item;
        }

        return $items;

//        return Cart::content()->map(function ($item){
//            $cart_item = new \stdClass();
//            $cart_item->item = $item->model;
//            $cart_item->qty = $item->model->id;
//            $cart_item->id = $item->rowId;
//
//            return $cart_item;
//        })->map(function ($item, $key){
//            return $item;
//        });
    }

    /**
     * Show cart page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "cart";
        $locations = DeliveryLocation::all();
        return view('cart.index', compact('page', 'locations'));
    }

    /**
     * Show cart page
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $delivery_location_id = $request->input('delivery_location_id');
        $user = null;

        if(Auth::user()){
            $user = Auth::user();
        }else{
            $name = $request->input('name');
            $phone = $request->input('phone_number');

            if(is_null($name) || is_null($phone) || is_null($delivery_location_id)){
                return back()->with('error', 'Some fields are missing');
            }

            $user = User::firstOrCreate([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number')
            ]);

            Auth::login($user);
        }

        if($user == null){
            return back()->with('success', 'User not found!');
        }

        $new_order = Order::create([
            'user_id' => $user->id,
            'delivery_location_id' => $delivery_location_id,
        ]);

        if($new_order){
            foreach(Cart::content() as $item){
                $new_order_item = OrderItem::create([
                    'order_id' => $new_order->id,
                    'product_id' => $item->model->id,
                    'quantity' => $item->qty
                ]);
            }
            Cart::destroy();
            return back()->with('success', 'Your Order has been successfully placed!');
        }else{
            return back()->with('error', 'Sorry, your order wasn\'t be placed. Please try again.');
        }
    }

    /**
     * Add item to cart
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $id = $request->input('id');
        $qty = $request->input('qty');
        $product = Product::find($id);

        if(!is_null($id) && !is_null($qty)){
            Cart::add(['id' => $id, 'name' => $product->name, 'qty' => $qty, 'price' => $product->price])
                ->associate('App\Product');

            $item = Cart::content()->last();
            $cart_item = new \stdClass();
            $cart_item->name = $item->model->name;
            $cart_item->image = $item->model->image();

            $cart_item->price = $item->model->present_price();
            $cart_item->qty = $item->qty;
            $cart_item->id = $item->rowId;

            return response()->json([
                "subtotal" => present_price(Cart::subtotal()),
                "subtotal_num" => number_format(Cart::subtotal()),
                "count" => Cart::count(),
                "success" => true,
                "added_item" => $cart_item
            ]);
        }

        return response()->json([
            "success" => false,
            "msg" => "Couldn't add item to cart."
        ]);
    }

    /**
     * Change quantity for item in cart
     *
     * @return \Illuminate\Http\Response
     */
    public function set_qty(Request $request)
    {
        $id = (int) $request->input('id');
        $qty = (int) $request->input('qty');

        if(!is_null($id) && !is_null($qty)){
            $item = Cart::search(function ($cartItem) use ($id) {
                return $cartItem->model->id === $id;
            })->first();

            Cart::update($item->rowId, $qty);

            return response()->json([
                "success" => true,
                "count" => Cart::count(),
                "subtotal_num" => number_format(Cart::subtotal()),
                "subtotal" => present_price(Cart::subtotal()),
                "changed_item_id" => $item->rowId,
                "new_value" => $qty
            ]);
        }

        return response()->json([
            "success" => false,
            "msg" => "Couldn't update item quantity."
        ]);
    }

    /**
     * Remove item from cart
     *
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $id = (int) $request->input('id');

        if(!is_null($id)){
            $item = Cart::search(function ($cartItem) use ($id) {
                return $cartItem->model->id === $id;
            })->first();

            if(!is_null($item)){
                Cart::remove($item->rowId);
                return response()->json([
                    "success" => true,
                    "count" => Cart::count(),
                    "subtotal_num" => number_format(Cart::subtotal()),
                    "subtotal" => present_price(Cart::subtotal()),
                    "msg" => "Item removed.",
                    "removed_item_id" => $item->rowId
                ]);
            }
        }

        return response()->json([
            "success" => false,
            "msg" => "id wasn't provided."
        ]);
    }
}
