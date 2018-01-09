<?php

namespace App\Http\Controllers;

use App\DeliveryLocation;
use App\Order;
use App\Product;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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
            $phone = $request->input('phone');

            if(is_null($name) || is_null($phone) || is_null($delivery_location_id)){
                return back()->with('error', 'Some fields are missing');
            }

            $user = User::firstOrCreate([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone')
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
            Cart::destroy();
            return back()->with('success', 'Order placed!');
        }else{
            return back()->with('success', 'Order wasn\'t placed!');
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

            return response()->json([
                "subtotal" => present_price(Cart::subtotal()),
                "count" => Cart::count(),
                "success" => true
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
                "subtotal" => present_price(Cart::subtotal()),
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
            Cart::remove($item->rowId);

            return response()->json([
                "success" => true,
                "count" => Cart::count(),
                "subtotal" => present_price(Cart::subtotal()),
                "msg" => "Item removed."
            ]);
        }

        return response()->json([
            "success" => false,
            "msg" => "id wasn't provided."
        ]);
    }
}
