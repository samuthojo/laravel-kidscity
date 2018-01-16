<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Orders extends Controller
{
    public function cmsIndex()
    {
      $orders = App\Order::latest('updated_at')->get()->map(function ($myOrder) {
        $order = $myOrder;
        $order->customer_name = $order->user()->first()->name;
        $order->customer_contact = $order->user()->first()->phone_number;
        $order->num_items = $order->orderItems()->count();
        $order->amount = $this->getAmount($myOrder);
        $order->delivery_location = $myOrder->deliveryLocation()->withTrashed()->first()->location;
        $order->delivery_price = $myOrder->deliveryLocation()->withTrashed()->first()->delivery_price;

        return $order;
      });

      return view('cms.orders', compact('orders'));
    }

    private function getAmount($order)
    {
      $amount = 0;
      foreach ($order->orderItems()->get() as $orderItem) {
        $price = $orderItem->product()->withTrashed()->first()->price;
        $amount += $price * $orderItem->quantity;
      }
      return $amount + $order->deliveryLocation()->withTrashed()->first()->delivery_price;
    }

    public function items(App\Order $order)
    {
      $items = $order->orderItems()
                     ->get()->map( function($it) {
                       $item = $it;
                       $product = $item->product()->withTrashed()->first();

                       $item->name = $product->name;
                       $item->category = $product->category()->withTrashed()->first()->name;
                       $item->price = $product->price;
                       $item->totalPrice = $product->price * $it->quantity;

                       return $item;
                     });
       $order = $this->getMappedOrder($order);
       return view('cms.order_items', compact('items', 'order'));
    }

    private function getMappedOrder($order)
    {
        $order->customer_name = $order->user()->first()->name;
        $order->customer_contact = $order->user()->first()->phone_number;
        $order->num_items = $order->orderItems()->count();
        $order->amount = $this->getAmount($order);
        $order->delivery_location = $order->deliveryLocation()->withTrashed()->first()->location;
        $order->delivery_price = $order->deliveryLocation()->withTrashed()->first()->delivery_price;

        return $order;
    }
}
