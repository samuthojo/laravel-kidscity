<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Orders extends Controller
{
    public function cmsIndex()
    {
      $orders = $this->getAllPendingOrders();

      return view('cms.orders', compact('orders'));
    }

    public function processed()
    {
      $orders = $this->getAllProcessedOrders();

      return view('cms.processed_orders', compact('orders'));
    }

    private function getAllPendingOrders()
    {
      return $orders =
        App\Order::latest('created_at')
                 ->where('processed', false)
                 ->get()->map(function ($myOrder) {
        $order = $myOrder;
        $order->customer_name = $order->user()->first()->name;
        $order->customer_contact = $order->user()->first()->phone_number;
        $order->num_items = $order->orderItems()->count();
        $order->amount = $this->getAmount($myOrder);
        $order->delivery_location = $myOrder->deliveryLocation()->withTrashed()->first()->location;
        $order->delivery_price = $myOrder->deliveryLocation()->withTrashed()->first()->delivery_price;

        return $order;
      });
    }

    private function getAllProcessedOrders()
    {
      return $orders =
        App\Order::latest('created_at')
                 ->where('processed', true)
                 ->get()->map(function ($myOrder) {
        $order = $myOrder;
        $order->customer_name = $order->user()->first()->name;
        $order->customer_contact = $order->user()->first()->phone_number;
        $order->num_items = $order->orderItems()->count();
        $order->amount = $this->getAmount($myOrder);
        $order->delivery_location = $myOrder->deliveryLocation()->withTrashed()->first()->location;
        $order->delivery_price = $myOrder->deliveryLocation()->withTrashed()->first()->delivery_price;

        return $order;
      });
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

    public function process($id)
    {
      App\Order::where(compact('id'))->update(['processed' => true, ]);
      $orders = $this->getAllPendingOrders();
      return view('cms.tables.orders_table', compact('orders'));
    }

    public function destroy(App\Order $order)
    {
      $isProcessed = $order->processed;

      $order->delete();

      if($isProcessed) {
        $orders = $this->getAllProcessedOrders();
        return view('cms.tables.processed_orders_table', compact('orders'));
      }

      $orders = $this->getAllPendingOrders();
      return view('cms.tables.orders_table', compact('orders'));
    }
}
